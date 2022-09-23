<?php

namespace CHStudio\Raven\Http\Factory;

use CHStudio\Raven\Http\Factory\Body\BodyResolverInterface;
use Psr\Http\Message\RequestInterface;

class RequestBodyResolver
{
    public function __construct(
        private readonly BodyResolverInterface $resolver,
        private readonly RequestFactoryInterface $decorated
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public function fromArray(array $data): RequestInterface
    {
        if (isset($data['body']) && \is_array($data['body'])) {
            $data['body'] = $this->resolver->resolve($data['body']);
        }

        return $this->decorated->fromArray($data);
    }
}
