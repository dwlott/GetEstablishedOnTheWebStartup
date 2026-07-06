# VerifyStarterPackage.ps1
# Run during StarterRepositoryPackage WorkflowIndex Step 6 in the packaging workspace.
# Exit 0 = pass; exit 1 = fail (blockers printed).

param(
    [string]$Root = (Get-Location).Path,
    [int]$ExpectedCaps = 12,
    [int]$ExpectedPlans = 10
)

$ErrorActionPreference = "Stop"
$failures = @()

function Add-Failure([string]$Message) {
    $script:failures += $Message
    Write-Host "FAIL: $Message" -ForegroundColor Red
}

function Add-Pass([string]$Message) {
    Write-Host "PASS: $Message" -ForegroundColor Green
}

Push-Location $Root
try {
    Write-Host "VerifyStarterPackage: $Root`n"

    # --- Structure removals ---
    foreach ($path in @(
        ".git", "Intake",
        "Capabilities/CodeAssistedIndexing",
        "Capabilities/StarterRepositoryPackage",
        "Capabilities/MirrorToDropbox",
        "Capabilities/MirrorToGoogleDrive",
        "Capabilities/MirrorToMac",
        "Automation/GoogleDriveRepositoryRefresh",
        "Automation/RepositoryRefresh",
        "Automation/RepositoryMirror",
        "Automation/AgentReplies"
    )) {
        if (Test-Path $path) { Add-Failure "Host path still present: $path" }
        else { Add-Pass "Absent: $path" }
    }

    # --- Agent traps (must not ship) ---
    foreach ($path in @(
        "AGENTS.md.placeholder",
        "README.md.placeholder",
        "STRUCTURE_MANIFEST.md"
    )) {
        if (Test-Path $path) { Add-Failure "Agent trap file present: $path (remove during Step 2b)" }
        else { Add-Pass "Absent trap: $path" }
    }

    # --- Counts ---
    $capCount = (Get-ChildItem "Capabilities" -Directory -ErrorAction SilentlyContinue).Count
    $plansCount = (Get-ChildItem "Plans" -File -Filter "*.md" -ErrorAction SilentlyContinue).Count

    if ($capCount -ne $ExpectedCaps) {
        Add-Failure "Capability folders: $capCount (expected $ExpectedCaps)"
    } else { Add-Pass "Capability folders: $capCount" }

    if ($plansCount -ne $ExpectedPlans) {
        Add-Failure "Plans files: $plansCount (expected $ExpectedPlans)"
    } else { Add-Pass "Plans files: $plansCount" }

    # --- Boot files ---
    foreach ($path in @(
        "AGENTS.md", "README.md",
        "Workspace/OwnerGoals.md", "Workspace/OwnerPreferences.md", "Workspace/ValuableReferences.md",
  "Capabilities/GettingStarted/GettingStarted.md",
  "Capabilities/RouterIndex.md",
  "Capabilities/MirrorToWindows/WorkflowIndex.md",
  "Capabilities/LocalAgentToolSetup/Vendors/ClaudeCode.md",
  "Indexes/ChatMarkdownIndex.md"
    )) {
        if (-not (Test-Path $path)) { Add-Failure "Missing boot file: $path" }
        else { Add-Pass "Present: $path" }
    }

    # --- Workspace boot-only ---
    $workspaceChildren = Get-ChildItem "Workspace" -Force -ErrorAction SilentlyContinue |
        Where-Object { $_.Name -ne ".gitkeep" }
    $allowedWorkspace = @("README.md", "OwnerGoals.md", "OwnerPreferences.md", "ValuableReferences.md")
    foreach ($item in $workspaceChildren) {
        if ($allowedWorkspace -notcontains $item.Name) {
            Add-Failure "Unexpected Workspace item: $($item.Name) (boot files only)"
        }
    }
    if ($workspaceChildren.Count -le 4) { Add-Pass "Workspace boot-only ($($workspaceChildren.Count) items)" }

    # --- AGENTS.md consumer identity ---
    if (Test-Path "AGENTS.md") {
        $agents = Get-Content "AGENTS.md" -Raw
        if ($agents -notmatch "Get Established Workspace") {
            Add-Failure "AGENTS.md missing 'Get Established Workspace'"
        } else { Add-Pass "AGENTS.md consumer identity" }

        if ($agents -notmatch "Begin Quick Startup from AGENTS\.md") {
            Add-Failure "AGENTS.md missing Quick Startup trigger phrase"
        } else { Add-Pass "AGENTS.md Quick Startup trigger" }

        if ($agents -notmatch "## Quick Start") {
            Add-Failure "AGENTS.md missing Quick Start section"
        } else { Add-Pass "AGENTS.md Quick Start section" }

        if ($agents -match "placeholder") {
            Add-Failure "AGENTS.md contains 'placeholder' text"
        }

        $hostPathMatches = Select-String -Path "AGENTS.md" -Pattern "C:\\GitHub\\GetEstablished" -AllMatches
        if ($hostPathMatches -and $hostPathMatches.Count -gt 1) {
            Add-Failure "AGENTS.md has multiple host path literals (negative example only)"
        } elseif ($hostPathMatches) { Add-Pass "AGENTS.md host path (negative example only)" }
    }

    # --- README.md consumer ---
    if (Test-Path "README.md") {
        $readme = Get-Content "README.md" -Raw
        if ($readme -notmatch "Get Established Workspace") {
            Add-Failure "README.md missing consumer identity"
        } else { Add-Pass "README.md consumer identity" }
        if ($readme -match "C:\\GitHub\\GetEstablished(?!.*do not assume)" -and $readme -notmatch "<YourProjectName>") {
            Add-Failure "README.md may still use host path as primary root"
        }
    }

    # --- AgentTaskBacklog Ready Next ---
    if (Test-Path "Plans/AgentTaskBacklog.md") {
        $backlog = Get-Content "Plans/AgentTaskBacklog.md" -Raw
        if ($backlog -notmatch "Quick Startup") {
            Add-Failure "AgentTaskBacklog.md Ready Next is not Quick Startup"
        } else { Add-Pass "AgentTaskBacklog Ready Next = Quick Startup" }
        if ($backlog -match "StarterRepositoryPackage|CapabilityAudit|RunWorkerPrompt") {
            Add-Failure "AgentTaskBacklog.md contains host-only backlog items"
        }
    }

    # --- Plans/StartHere must not reference removed Plans ---
    if (Test-Path "Plans/StartHere.md") {
        $startHere = Get-Content "Plans/StartHere.md" -Raw
        $removedPlanNames = @(
            "PrimeExamplePlan", "IdentityAndMission", "TargetAudience",
            "WebsiteContentPlan", "AIWorkflowPlan", "Roadmap.md"
        )
        foreach ($name in $removedPlanNames) {
            if ($startHere -match [regex]::Escape($name)) {
                Add-Failure "Plans/StartHere.md references removed host plan: $name"
            }
        }
        if ($startHere -notmatch "Begin Quick Startup from AGENTS\.md") {
            Add-Failure "Plans/StartHere.md missing Quick Startup redirect"
        } else { Add-Pass "Plans/StartHere.md Quick Startup redirect" }
        if ($startHere -match "lightweight project direction for GetEstablished") {
            Add-Failure "Plans/StartHere.md still uses host framing"
        }
        if (-not ($failures | Where-Object { $_ -like "Plans/StartHere*" })) {
            Add-Pass "Plans/StartHere.md consumer orientation"
        }
    } else {
        Add-Failure "Missing Plans/StartHere.md"
    }

    # --- Consumer registry: no RepositorySpawn ---
    foreach ($regFile in @(
        "Capabilities/README.md",
        "Capabilities/RouterIndex.md",
        "Capabilities/AgentCapabilityGuide.md"
    )) {
        if (Test-Path $regFile) {
            $regContent = Get-Content $regFile -Raw
            if ($regContent -match "RepositorySpawn") {
                Add-Failure "$regFile references retired RepositorySpawn"
            } else { Add-Pass "$regFile no RepositorySpawn" }
        }
    }

    # --- RouterIndex parity ---
    if ((Test-Path "Capabilities/RouterIndex.md") -and (Test-Path "Capabilities")) {
        $routerRows = (Select-String -Path "Capabilities/RouterIndex.md" -Pattern "^\| [A-Z]" |
            Where-Object { $_.Line -notmatch "Capability \|" }).Count
        if ($routerRows -ne $capCount) {
            Add-Failure "RouterIndex rows ($routerRows) != Capability folders ($capCount)"
        } else { Add-Pass "RouterIndex parity ($routerRows rows)" }
    }

    # --- Home CTA ---
    if (Test-Path "Content/Website/Pages/Home.md") {
        $homeMd = Get-Content "Content/Website/Pages/Home.md" -Raw
        if ($homeMd -notmatch "Get Established") {
            Add-Failure "Home.md missing 'Get Established' CTA"
        } else { Add-Pass "Home.md Get Established CTA" }
    } else {
        Add-Failure "Missing Content/Website/Pages/Home.md"
    }

    # --- Consumer Quick Startup (no Import* routing) ---
    if (Test-Path "Capabilities/GettingStarted/GettingStarted.md") {
        $gs = Get-Content "Capabilities/GettingStarted/GettingStarted.md" -Raw
        if ($gs -match "ImportCapabilitiesFromRepository|ImportOwnerPreferencesFromRepository") {
            Add-Failure "GettingStarted.md routes to Import* Capabilities (not shipped)"
        } else { Add-Pass "GettingStarted.md no Import* routing" }
        if ($gs -match "OwnerEnvironment\.md") {
            Add-Failure "GettingStarted.md references OwnerEnvironment.md (not in consumer boot)"
        } else { Add-Pass "GettingStarted.md uses OwnerPreferences for environment" }
    }

    # --- Archive minimal ---
    if (Test-Path "Archive") {
        $archiveItems = Get-ChildItem "Archive" -Force | Where-Object { $_.Name -ne ".gitkeep" }
        foreach ($item in $archiveItems) {
            if ($item.Name -ne "README.md") {
                Add-Failure "Archive contains host pollution: $($item.Name) (keep README.md only)"
            }
        }
        if (-not ($failures | Where-Object { $_ -like "Archive*" })) {
            Add-Pass "Archive minimal (README only)"
        }
    }

    # --- No RepositorySpawn anywhere under Capabilities ---
    $spawnHits = Get-ChildItem "Capabilities" -Recurse -File -ErrorAction SilentlyContinue |
        Select-String -Pattern "RepositorySpawn" -ErrorAction SilentlyContinue
    if ($spawnHits) {
        Add-Failure "RepositorySpawn references under Capabilities/ ($($spawnHits.Count) hit(s))"
    } else { Add-Pass "Capabilities/ no RepositorySpawn" }

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
