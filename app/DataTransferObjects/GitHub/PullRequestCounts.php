<?php

namespace App\DataTransferObjects\GitHub;

final readonly class PullRequestCounts
{
    public function __construct(
        public int $total,
        public int $open,
        public int $merged,
        public int $closed,
    ) {}

    public static function fromGraphQL(array $data): self
    {
        $repo = $data['repository'] ?? [];

        return new self(
            total: $repo['pullRequests']['totalCount'] ?? 0,
            open: $repo['openPullRequests']['totalCount'] ?? 0,
            merged: $repo['mergedPullRequests']['totalCount'] ?? 0,
            closed: $repo['closedPullRequests']['totalCount'] ?? 0,
        );
    }

    public function summary(): string
    {
        return "Total: $this->total, Open: $this->open, Merged: $this->merged, Closed: $this->closed";
    }
}
