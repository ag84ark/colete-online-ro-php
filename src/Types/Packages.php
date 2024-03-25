<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

class Packages extends BaseType
{
    protected string $content = '';

    protected PackageTypeEnum $type;

    /**
     * @var PackageItem[]
     */
    protected array $list = [];

    public function __construct(PackageTypeEnum $type, string $content)
    {
        $this->type = $type;
        $this->content = $content;
    }

    public function toArray(): array
    {
        $data = [
            'content' => $this->content,
            'type' => $this->type->value,
            'list' => [],
        ];

        foreach ($this->list as $packageItem) {
            $data['list'][] = $packageItem->toArray();
        }

        return $data;
    }

    public function addPackageItem(PackageItem $packageItem): self
    {
        $this->list[] = $packageItem;

        return $this;
    }
}
