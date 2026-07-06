# Index Health Check
#
# Read-only scan for GetEstablished clean-root index readiness.
# Does not create Indexes/ or modify source files.
#
# Usage:
#   .\Automation\IndexHealthCheck\Run-IndexHealthCheck.ps1
#   .\Automation\IndexHealthCheck\Run-IndexHealthCheck.ps1 -ReportPath Plans\IndexHealthReport.md

param(
    [string]$RepositoryRoot = (Split-Path (Split-Path $PSScriptRoot -Parent) -Parent),
    [string]$ReportPath = ""
)

Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

$findings = [System.Collections.Generic.List[object]]::new()

function Add-Finding {
    param([string]$Domain, [string]$Severity, [string]$Path, [string]$Message)
    $findings.Add([pscustomobject]@{
            Domain   = $Domain
            Severity = $Severity
            Path     = $Path
            Message  = $Message
        })
}

function Test-MarkdownLinkTarget {
    param([string]$Root, [string]$SourceFile, [string]$LinkTarget)
    if ($LinkTarget -match '^(https?|mailto):') { return $true }
    if ($LinkTarget.StartsWith('#')) { return $true }
    $base = Split-Path $SourceFile -Parent
    $candidate = [System.IO.Path]::GetFullPath((Join-Path $base $LinkTarget))
    if (Test-Path $candidate) { return $true }
    if (Test-Path "$candidate.md") { return $true }
    return $false
}

Push-Location $RepositoryRoot

# --- Capability metadata ---
$capRoot = Join-Path $RepositoryRoot "Capabilities"
$registryCaps = @{}
$registryPath = Join-Path $capRoot "README.md"
if (Test-Path $registryPath) {
    $regContent = Get-Content $registryPath -Raw
    foreach ($match in [regex]::Matches($regContent, '\|\s*(Universal|Archetype|Commissioned|N/A)\s*\|\s*(\w+)\s*\|[^|]*\|\s*(Active(?:\s*\([^)]+\))?|Draft|Planned|Scaffold)\s*\|')) {
        $status = ($match.Groups[3].Value -replace '\s*\(.*\)', '').Trim()
        $registryCaps[$match.Groups[2].Value] = $status
    }
}

Get-ChildItem $capRoot -Directory -ErrorAction SilentlyContinue | ForEach-Object {
    $name = $_.Name
    if ($name -in @('AgentCapabilityGuide.md')) { return }
    $status = if ($registryCaps.ContainsKey($name)) { $registryCaps[$name] } else { 'Unknown' }
    if ($status -in @('Scaffold', 'Planned', 'Draft')) { return }
    $readme = Join-Path $_.FullName "README.md"
    if (-not (Test-Path $readme)) {
        $severity = if ($status -eq 'Active') { 'Must-fix' } else { 'Should-fix' }
        Add-Finding "CapabilityMetadata" $severity $_.FullName "Capability folder missing README.md (registry status: $status)"
        return
    }
    $text = Get-Content $readme -Raw
    if ($text -notmatch 'Harmonization Metadata') {
        Add-Finding "CapabilityMetadata" "Should-fix" $readme "README missing Harmonization Metadata section"
    }
}

# --- Folder README coverage ---
@("Plans", "Standards", "Content", "Ideas", "Workspace", "Automation") | ForEach-Object {
    $dir = Join-Path $RepositoryRoot $_
    if (-not (Test-Path $dir)) { return }
    $readme = Join-Path $dir "README.md"
    if (-not (Test-Path $readme)) {
        Add-Finding "FolderReadme" "Should-fix" $dir "Missing README.md"
    }
}

# --- Legacy Docs/ paths in active scan roots ---
$legacyPattern = 'Docs/(Project|Capabilities|Setup|Prompts|Standards)/'
$scanRoots = @("AGENTS.md", "Plans", "Capabilities", "Standards", "README.md")
foreach ($item in $scanRoots) {
    $full = Join-Path $RepositoryRoot $item
    if (-not (Test-Path $full)) { continue }
    if (Test-Path $full -PathType Leaf) {
        $files = @(Get-Item $full)
    } else {
        $files = Get-ChildItem $full -Recurse -File -Filter "*.md" |
            Where-Object { $_.FullName -notmatch '\\Archive\\|\\Intake\\' }
    }
    foreach ($f in $files) {
        $lines = Select-String -Path $f.FullName -Pattern $legacyPattern -SimpleMatch:$false -ErrorAction SilentlyContinue
        foreach ($line in $lines) {
            Add-Finding "LegacyPath" "Should-fix" $f.FullName "Legacy Docs/ path reference at line $($line.LineNumber)"
        }
    }
}

# --- Metadata blocks on key boot files ---
@("AGENTS.md", "Plans\RepositorySearchMap.md", "Plans\RepositoryGoals.md", "Standards\README.md") | ForEach-Object {
    $p = Join-Path $RepositoryRoot $_
    if (-not (Test-Path $p)) { return }
    $text = Get-Content $p -Raw
    if ($text -notmatch 'IndexTitle:') {
        Add-Finding "DocumentMetadata" "Should-fix" $p "Missing metadata block (IndexTitle)"
    }
}

# --- Source of truth spot check ---
$agents = Get-Content (Join-Path $RepositoryRoot "AGENTS.md") -Raw -ErrorAction SilentlyContinue
$sot = Get-Content (Join-Path $RepositoryRoot "Standards\SourceOfTruthAndMirrorStandard.md") -Raw -ErrorAction SilentlyContinue
if ($agents -and $sot) {
    if ($agents -notmatch 'Local Git' -and $agents -notmatch 'local Git') {
        Add-Finding "SourceOfTruth" "Must-fix" "AGENTS.md" "Missing local Git source-of-truth language"
    }
    if ($agents -match 'copy files to Dropbox|copy files to Google Drive' -and $agents -notmatch 'only when|explicitly|on demand|on-demand') {
        Add-Finding "SourceOfTruth" "Should-fix" "AGENTS.md" "Cloud copy language may imply routine mirroring"
    }
}

# --- Broken markdown links (sample: Capabilities and Plans top-level) ---
$linkFiles = @()
$linkFiles += Get-ChildItem (Join-Path $RepositoryRoot "Capabilities") -Recurse -File -Filter "*.md" -ErrorAction SilentlyContinue |
    Where-Object { $_.FullName -notmatch '\\Archive\\|\\Intake\\' } | Select-Object -First 80
$linkFiles += Get-ChildItem (Join-Path $RepositoryRoot "Plans") -File -Filter "*.md" -ErrorAction SilentlyContinue | Select-Object -First 40

foreach ($f in $linkFiles) {
    $content = Get-Content $f.FullName -Raw
    foreach ($match in [regex]::Matches($content, '\[[^\]]+\]\(([^)]+)\)')) {
        $target = $match.Groups[1].Value
        if (-not (Test-MarkdownLinkTarget -Root $RepositoryRoot -SourceFile $f.FullName -LinkTarget $target)) {
            Add-Finding "BrokenLink" "Should-fix" $f.FullName "Broken link target: $target"
        }
    }
}

# --- Stale plan signals (lightweight) ---
$openQuestions = Join-Path $RepositoryRoot "Plans\OpenQuestions.md"
if (Test-Path $openQuestions) {
    $oq = Get-Content $openQuestions -Raw
    if ($oq -match '\|\s*Decided\s*\|' -and $oq -notmatch 'Decided.*\|\s*[^|]+\s*\|\s*[^|]+\s*\|\s*[^|\s]') {
        Add-Finding "StalePlan" "Optional" $openQuestions "Decided rows may need target updates (spot check)"
    }
}
$backlog = Join-Path $RepositoryRoot "Plans\AgentTaskBacklog.md"
if (Test-Path $backlog) {
    $bl = Get-Content $backlog -Raw
    if ($bl -match 'Ready Next' -and $bl -match '\[x\]|Completed|Done') {
        Add-Finding "StalePlan" "Optional" $backlog "Ready Next section may reference completed work (spot check)"
    }
}

# --- Deprecated references in active maps ---
$searchMap = Join-Path $RepositoryRoot "Plans\RepositorySearchMap.md"
if (Test-Path $searchMap) {
    $sm = Get-Content $searchMap -Raw
    if ($sm -match 'Docs/Project/|Docs/Capabilities/') {
        Add-Finding "DeprecatedReference" "Should-fix" $searchMap "Search map still references legacy Docs/ paths"
    }
}

# --- Indexes/ status ---
$indexesPath = Join-Path $RepositoryRoot "Indexes"
$indexesExists = Test-Path $indexesPath
$indexSourceFolders = @(
    @{ Folder = 'Plans/'; Role = 'plans, backlog, maps, registers -> ChatMarkdownIndex + FollowThroughIndex' }
    @{ Folder = 'Content/Website/Pages/'; Role = 'publishable page drafts -> ChatMarkdownIndex' }
    @{ Folder = 'Workspace/'; Role = 'owner working files -> pointer rows only (content stays put)' }
    @{ Folder = 'Capabilities/README.md, AgentCapabilityGuide.md'; Role = 'optional routing snapshot rows' }
)
$indexOutputFiles = @(
    'Indexes/ChatMarkdownIndex.md — per-file topic, status, decisions, routing'
    'Indexes/FollowThroughIndex.md — tasks and questions pulled from planning files'
    'Indexes/README.md — explains generated tables (not source of truth)'
)
$setupPromptRel = 'Capabilities/Indexing/SetupPrompt.md'
$workflowIndexRel = 'Capabilities/Indexing/WorkflowIndex.md'
$refreshPromptRel = 'Capabilities/Indexing/Prompt.md'

if (-not $indexesExists) {
    Add-Finding "IndexingProvision" "Recommend" "Indexes/" @"
Repository navigation indexes are not provisioned. On the archetype host this is normal until owner-approved Setup creates Indexes/ (empty table shells). Source material stays in Plans/, Content/, and Workspace/ — Indexes/ only holds generated summary tables. Strong recommendation: run Indexing Setup ($setupPromptRel), then refresh ($refreshPromptRel). See $workflowIndexRel.
"@
} else {
    foreach ($required in @('README.md', 'ChatMarkdownIndex.md', 'FollowThroughIndex.md')) {
        $reqPath = Join-Path $indexesPath $required
        if (-not (Test-Path $reqPath)) {
            Add-Finding "IndexingProvision" "Recommend" $indexesPath "Indexes/ is partial — missing $required. Run Setup repair via $setupPromptRel before refresh."
        }
    }
}

function Get-IndexingContextText {
    param([bool]$Provisioned)
    $lines = @(
        'What this check does:',
        '  Validates repository self-description BEFORE or WITHOUT a full index refresh:',
        '  capability metadata, folder READMEs, legacy path references, link targets,',
        '  stale-plan signals, and source-of-truth language.',
        '',
        'What Indexing (Setup + refresh) would summarize — source folders -> Indexes/:'
    )
    foreach ($src in $indexSourceFolders) {
        $exists = if ($src.Folder -match '\.md$') {
            ($src.Folder -split ',\s*' | ForEach-Object {
                    Test-Path (Join-Path $RepositoryRoot ($_.Trim() -replace '^Capabilities/', 'Capabilities\'))
                }) -contains $true
        } else {
            Test-Path (Join-Path $RepositoryRoot ($src.Folder.TrimEnd('/') -replace '/', '\'))
        }
        $flag = if ($exists) { 'present' } else { 'missing' }
        $lines += "  $($src.Folder) ($flag)"
        $lines += "    -> $($src.Role)"
    }
    $lines += ''
    $lines += 'Generated files under Indexes/ (not copies of source bodies):'
    foreach ($out in $indexOutputFiles) { $lines += "  - $out" }
    $lines += ''
    if (-not $Provisioned) {
        $lines += 'Indexes/ status: NOT PROVISIONED on this repository.'
        $lines += ''
        $lines += '>>> STRONG RECOMMENDATION'
        $lines += 'Run Indexing Setup once (owner approval required):'
        $lines += "  $setupPromptRel"
        $lines += 'Then run a refresh pass to populate the tables:'
        $lines += "  $refreshPromptRel"
        $lines += 'Workflow: Capabilities/Indexing/WorkflowIndex.md'
        $lines += ''
        $lines += 'You can keep using RepositorySearchMap.md and the capability registry without Indexes/.'
        $lines += 'Setup is recommended when agents or humans need rolling inventory tables.'
    } else {
        $lines += 'Indexes/ status: provisioned.'
        $lines += 'Run a refresh pass when source files changed materially:'
        $lines += "  $refreshPromptRel"
    }
    return ($lines -join "`n")
}

$indexingContext = Get-IndexingContextText -Provisioned $indexesExists

# --- Summary ---
$must = @($findings | Where-Object Severity -eq 'Must-fix')
$should = @($findings | Where-Object Severity -eq 'Should-fix')
$optional = @($findings | Where-Object Severity -eq 'Optional')
$recommend = @($findings | Where-Object Severity -eq 'Recommend')

$summary = @"
Index Health Check — $RepositoryRoot
Indexes/ provisioned: $indexesExists
Must-fix: $($must.Count)
Should-fix: $($should.Count)
Recommend: $($recommend.Count)
Optional: $($optional.Count)
"@

Write-Host $indexingContext
Write-Host ''
Write-Host $summary

if ($findings.Count -gt 0) {
    $displayOrder = @('IndexingProvision', 'CapabilityMetadata', 'DocumentMetadata', 'FolderReadme', 'SourceOfTruth', 'DeprecatedReference', 'LegacyPath', 'BrokenLink', 'StalePlan')
    $grouped = $findings | Group-Object Domain
    foreach ($domainName in $displayOrder) {
        $group = $grouped | Where-Object Name -eq $domainName
        if (-not $group) { continue }
        Write-Host "`n[$domainName]"
        $group.Group | Select-Object -First 15 | ForEach-Object {
            Write-Host "  [$($_.Severity)] $($_.Path): $($_.Message)"
        }
        if ($group.Count -gt 15) { Write-Host "  ... and $($group.Count - 15) more" }
    }
    $other = $grouped | Where-Object { $_.Name -notin $displayOrder }
    foreach ($group in $other) {
        Write-Host "`n[$($group.Name)]"
        $group.Group | Select-Object -First 15 | ForEach-Object {
            Write-Host "  [$($_.Severity)] $($_.Path): $($_.Message)"
        }
        if ($group.Count -gt 15) { Write-Host "  ... and $($group.Count - 15) more" }
    }
}

if ($ReportPath) {
    $reportFull = if ([System.IO.Path]::IsPathRooted($ReportPath)) { $ReportPath } else { Join-Path $RepositoryRoot $ReportPath }
    $lines = @(
        "# Index Health Report",
        "",
        "Generated: $(Get-Date -Format 'yyyy-MM-dd')",
        "",
        "## What This Check Covers",
        "",
        ($indexingContext -split "`n" | ForEach-Object { $_ }),
        "",
        "## Summary",
        "",
        $summary,
        "",
        "## Findings",
        "",
        "| Domain | Severity | Path | Message |",
        "| --- | --- | --- | --- |"
    )
    foreach ($f in $findings) {
        $path = $f.Path.Replace('|', '/')
        $msg = $f.Message.Replace('|', '/')
        $lines += "| $($f.Domain) | $($f.Severity) | $path | $msg |"
    }
    $lines += ""
    $lines += "## Indexes/ Status"
    $lines += ""
    $lines += "| Indexes/ exists | $indexesExists |"
    if (-not $indexesExists) {
        $lines += ""
        $lines += "## Strong Recommendation"
        $lines += ""
        $lines += "Run **Indexing Setup** once via ``$setupPromptRel`` (owner approval), then refresh via ``$refreshPromptRel``. Workflow: ``$workflowIndexRel``."
    }
    Set-Content -Path $reportFull -Value ($lines -join "`n") -Encoding utf8
    Write-Host "`nReport written: $reportFull"
}

Pop-Location

if ($must.Count -gt 0) { exit 2 }
if ($should.Count -gt 0) { exit 1 }
exit 0
