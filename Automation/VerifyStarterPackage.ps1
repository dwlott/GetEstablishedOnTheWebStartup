# VerifyStarterPackage.ps1
# Packaging verification for starter profiles.
# Exit 0 = pass; exit 1 = fail.

param(
    [string]$Root = (Get-Location).Path,
    [ValidateSet('Consumer', 'WebPresence', 'WebPresenceWordPress')]
    [string]$Profile = 'Consumer'
)

$ErrorActionPreference = "Stop"
$failures = @()

switch ($Profile) {
    'Consumer' { $ExpectedCaps = 12; $ExpectedPlans = 10 }
    'WebPresence' { $ExpectedCaps = 26; $ExpectedPlans = 14 }
    'WebPresenceWordPress' { $ExpectedCaps = 31; $ExpectedPlans = 24 }
}

function Add-Failure([string]$Message) {
    $script:failures += $Message
    Write-Host "FAIL: $Message" -ForegroundColor Red
}

function Add-Pass([string]$Message) {
    Write-Host "PASS: $Message" -ForegroundColor Green
}

Push-Location $Root
try {
    Write-Host "VerifyStarterPackage: $Root (Profile: $Profile)`n"

    if (Test-Path "Intake") {
        Add-Failure "Host path still present: Intake"
    } else { Add-Pass "Absent: Intake" }

    # Packaging workspace: .git absent. Adopted starter: own remote OK.
    # Fail only when origin still points at the archetype product host.
    if (-not (Test-Path ".git")) {
        Add-Pass "Absent: .git (packaging workspace)"
    } else {
        $originUrl = ''
        try {
            $originUrl = (& git remote get-url origin 2>$null)
            if (-not $originUrl) { $originUrl = '' }
        } catch { $originUrl = '' }

        $isHostRemote = $false
        if ($Profile -eq 'Consumer') {
            if ($originUrl -match 'GetEstablished\.git' -and $originUrl -notmatch 'Startup') { $isHostRemote = $true }
        } else {
            if ($originUrl -match 'GetEstablishedOnTheWeb\.git' -and $originUrl -notmatch 'Startup') { $isHostRemote = $true }
        }

        if ($isHostRemote) {
            Add-Failure "Host git remote still present: $originUrl"
        } else {
            Add-Pass "Git OK (adopted starter or non-host remote)"
        }
    }

    if ($Profile -eq 'Consumer') {
        foreach ($path in @(
            "Capabilities/CodeAssistedIndexing",
            "Automation/GoogleDriveRepositoryRefresh",
            "Automation/RepositoryRefresh",
            "Automation/AgentReplies"
        )) {
            if (Test-Path $path) { Add-Failure "Host path still present: $path" }
            else { Add-Pass "Absent: $path" }
        }
    }

    $capCount = (Get-ChildItem "Capabilities" -Directory -ErrorAction SilentlyContinue).Count
    $plansCount = (Get-ChildItem "Plans" -File -Filter "*.md" -ErrorAction SilentlyContinue).Count

    if ($capCount -ne $ExpectedCaps) {
        Add-Failure "Capability folders: $capCount (expected $ExpectedCaps)"
    } else { Add-Pass "Capability folders: $capCount" }

    if ($plansCount -ne $ExpectedPlans) {
        Add-Failure "Plans files: $plansCount (expected $ExpectedPlans)"
    } else { Add-Pass "Plans files: $plansCount" }

    foreach ($path in @(
        "AGENTS.md", "README.md",
        "Workspace/OwnerGoals.md", "Workspace/OwnerPreferences.md",
        "Capabilities/GettingStarted/GettingStarted.md",
        "Capabilities/RouterIndex.md"
    )) {
        if (-not (Test-Path $path)) { Add-Failure "Missing boot file: $path" }
        else { Add-Pass "Present: $path" }
    }

    if ($Profile -eq 'Consumer') {
        if (Test-Path "AGENTS.md") {
            $agents = Get-Content "AGENTS.md" -Raw
            if ($agents -notmatch "Get Established Workspace") { Add-Failure "AGENTS.md missing consumer identity" }
            else { Add-Pass "AGENTS.md consumer identity" }
        }
    }

    if ($Profile -in @('WebPresence', 'WebPresenceWordPress')) {
        if (Test-Path "AGENTS.md") {
            $agents = Get-Content "AGENTS.md" -Raw
            if ($agents -notmatch "Get Established On The Web Startup") { Add-Failure "AGENTS.md missing WebPresence starter identity" }
            else { Add-Pass "AGENTS.md WebPresence starter identity" }
            if (Select-String -Path "AGENTS.md" -Pattern "This is the \*\*Get Established On The Web product repository\*\*" -Quiet) {
                Add-Failure "AGENTS.md still declares GEOTW product repository identity"
            } else { Add-Pass "AGENTS.md starter identity (not product host)" }
        }
    }

    if ($Profile -eq 'WebPresenceWordPress') {
        foreach ($path in @(
            "Workspace/LocalWordPressBuild/ges-build.php",
            "Workspace/LocalWordPressBuild/site-manifest.json",
            "Capabilities/MirrorWebAssets/README.md",
            "Automation/WordPressSave/Save-LocalWordPress.ps1",
            "Automation/LocalWordPress/WampPaths.ps1",
            "Automation/DatabaseBackups/Export-LocalWordPressDatabase.ps1",
            "Plans/WordPressSaveWorkflow.md",
            "Plans/LocalWordPressSetupPlan.md",
            "Plans/WordPressWebsiteCapabilityGroupPlan.md"
        )) {
            if (-not (Test-Path $path)) { Add-Failure "Missing WordPress layer file: $path" }
            else { Add-Pass "Present: $path" }
        }

        foreach ($path in @(
            "Capabilities/AltitudeProOverlay",
            "Capabilities/WordPressSave"
        )) {
            if (Test-Path $path) { Add-Failure "Commissioned-only Cap must stay out of starter: $path" }
            else { Add-Pass "Absent (intentional): $path" }
        }
    }

    if ((Test-Path "Capabilities/RouterIndex.md") -and (Test-Path "Capabilities")) {
        $routerRows = (Select-String -Path "Capabilities/RouterIndex.md" -Pattern "^\| ([A-Za-z]+) \|" |
            Where-Object { $_.Matches.Groups[1].Value -ne 'Capability' }).Count
        if ($routerRows -ne $capCount) {
            Add-Failure "RouterIndex rows ($routerRows) != Capability folders ($capCount)"
        } else { Add-Pass "RouterIndex parity ($routerRows rows)" }
    }

    if (Test-Path "Plans/AgentTaskBacklog.md") {
        $backlog = Get-Content "Plans/AgentTaskBacklog.md" -Raw
        if ($backlog -notmatch "Quick Startup|site-manifest") {
            Add-Failure "AgentTaskBacklog.md missing starter Ready Next items"
        } else { Add-Pass "AgentTaskBacklog starter tasks" }
    }

    Write-Host ""
    if ($failures.Count -gt 0) {
        Write-Host "RESULT: NOT READY ($($failures.Count) blocker(s))" -ForegroundColor Red
        exit 1
    }

    Write-Host "RESULT: PACKAGE READY" -ForegroundColor Green
    exit 0
}
finally {
    Pop-Location
}
