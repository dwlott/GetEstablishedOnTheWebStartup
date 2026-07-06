# RepoGitOutput.ps1
#
# Save git command output to git-workflow-output.txt in each repository root
# while still printing to the console. Easier to review than Start-Transcript
# across multiple repositories.
#
# Dot-source once per PowerShell session:
#   . C:\Repositories\GetEstablished\Capabilities\GitHubWorkflow\RepoGitOutput.ps1
#
# Optional: disable file logging for the session
#   $SaveGitOutputToFile = $false
#
# Optional: disable file logging for one repository visit
#   Start-RepoGitLog -NoSave

Set-StrictMode -Version Latest

if (-not (Get-Variable -Name SaveGitOutputToFile -Scope Script -ErrorAction SilentlyContinue)) {
    $script:SaveGitOutputToFile = $true
}

$script:RepoGitLogFile = $null

function Start-RepoGitLog {
    param(
        [string]$RepositoryPath = (Get-Location).ProviderPath,
        [switch]$NoSave
    )

    if (-not (Test-Path -LiteralPath $RepositoryPath)) {
        throw "Repository path not found: $RepositoryPath"
    }

    Set-Location -LiteralPath $RepositoryPath

    if ($NoSave) {
        $script:SaveGitOutputToFile = $false
        $script:RepoGitLogFile = $null
        return
    }

    $script:SaveGitOutputToFile = $true
    $script:RepoGitLogFile = Join-Path $RepositoryPath 'git-workflow-output.txt'

    $banner = @"
################################################################################
# Git workflow output log
# Repository: $RepositoryPath
# Session started: $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')
################################################################################
"@

    Add-Content -LiteralPath $script:RepoGitLogFile -Encoding utf8 -Value "`r`n$banner"
    Write-Host "Saving git output to $script:RepoGitLogFile" -ForegroundColor Cyan
}

function Invoke-GitWithLog {
    param(
        [Parameter(ValueFromRemainingArguments = $true)]
        [string[]]$GitArgs
    )

    $commandLine = "git $($GitArgs -join ' ')"
    $timestamp = Get-Date -Format 'yyyy-MM-dd HH:mm:ss'
    $header = "===== $commandLine ===== $timestamp ====="

    Write-Host $header -ForegroundColor DarkGray

    $output = & git @GitArgs 2>&1
    $exitCode = $LASTEXITCODE

    foreach ($line in @($output)) {
        Write-Host ($line.ToString())
    }

    if ($script:SaveGitOutputToFile -and $script:RepoGitLogFile) {
        $text = if ($null -eq $output -or $output.Count -eq 0) {
            '(no output)'
        }
        else {
            ($output | ForEach-Object { $_.ToString() }) -join "`r`n"
        }

        Add-Content -LiteralPath $script:RepoGitLogFile -Encoding utf8 -Value @"

$header
$text
(exit code: $exitCode)
"@
    }

    $global:LASTEXITCODE = $exitCode
    return $output
}

function Stop-RepoGitLog {
    if ($script:SaveGitOutputToFile -and $script:RepoGitLogFile) {
        $footer = "===== session ended $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss') ====="
        Add-Content -LiteralPath $script:RepoGitLogFile -Encoding utf8 -Value "`r`n$footer"
    }

    $script:RepoGitLogFile = $null
}
