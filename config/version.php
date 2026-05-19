<?php

$appVersion = env('APP_VERSION');
$appVersionUrl = env('APP_VERSION_URL');

// Se não existir (Ambiente Local)
if (! $appVersion) {
    $baseVersion = 'v0.1';
    $versionPath = base_path('version.env');

    if (file_exists($versionPath)) {
        $envContent = file_get_contents($versionPath);
        if (preg_match('/^BASE_VERSION=(.*)$/m', $envContent, $matches)) {
            $baseVersion = trim($matches[1]);
        }
    }

    $branch = 'dev';
    $fullHash = '';

    if (is_dir(base_path('.git'))) {
        $gitBranch = trim(@exec('git rev-parse --abbrev-ref HEAD 2>/dev/null'));
        if (! empty($gitBranch)) {
            $branch = $gitBranch;
        }

        // Pega o Hash completo para o link local funcionar
        $gitFullHash = trim(@exec('git rev-parse HEAD 2>/dev/null'));
        if (! empty($gitFullHash)) {
            $fullHash = $gitFullHash;
        }
    }

    $appVersion = "{$baseVersion}-{$branch}";

    // Substitua "bulfaitelo/OSLab" pelo nome real do seu repositório no GitHub
    $repoPath = env('GITHUB_REPO', 'bulfaitelo/OSLab');
    if ($branch !== 'dev') {
        $appVersionUrl = "https://github.com/{$repoPath}/commit/{$fullHash}";
    } else {
        $appVersionUrl = "https://github.com/{$repoPath}/commits";
    }
}

return [
    'show' => env('SHOW_VERSION', true),
    'number' => $appVersion,
    'url' => $appVersionUrl,
];
