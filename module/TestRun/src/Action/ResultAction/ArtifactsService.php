<?php

namespace TestRun\Action\ResultAction;

use T4webDomainInterface\ServiceInterface;

/**
 * Class ArtifactsService
 * @package TestRun\Action\ResultAction
 */
class ArtifactsService implements ServiceInterface
{
    /**
     * @inheritDoc
     */
    public function handle($criteria, $changes)
    {
        $basePath = implode(DIRECTORY_SEPARATOR, [
            getenv('DOCUMENT_ROOT'),
            'img', 'artifacts', $criteria['id']
        ]);

        if (!is_dir($basePath) && !mkdir($basePath)) {
            throw new \RuntimeException("Can't create directory");
        }

        $picturePath = implode(DIRECTORY_SEPARATOR, [
            $basePath,
            $changes['name']
        ]);

        file_put_contents($picturePath, base64_decode($changes['data']));

        return 'ok';
    }
}