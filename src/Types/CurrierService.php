<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

class CurrierService
{
    /**
     * @param  array<ServiceGradesTypeEnum>|null  $grades
     */
    public function __construct(
        public readonly ServiceSelectionTypeEnum $selectionType,
        public readonly ?array $serviceIds = null,
        public readonly ?array $grades = null,
    ) {
        $this->validate();
    }

    public function toArray(): array
    {
        $data = [
            'selectionType' => $this->selectionType,
        ];
        if ($this->serviceIds) {
            $data['serviceIds'] = $this->serviceIds;
        }

        if ($this->selectionType === ServiceSelectionTypeEnum::Grade) {
            foreach ($this->grades as $grade) {
                $data['grades'][] = $grade->value;
            }
        }

        return $data;
    }

    private function validate(): void
    {
        if ($this->selectionType === ServiceSelectionTypeEnum::Grade) {
            if (empty($this->grades)) {
                throw new \InvalidArgumentException('grades must be provided when selectionType is Grade');
            }
            foreach ($this->grades as $grade) {
                if (! ($grade instanceof ServiceGradesTypeEnum)) {
                    throw new \InvalidArgumentException('grades must be an array of ServiceGradesTypeEnum');
                }
            }
        }

        if ($this->selectionType === ServiceSelectionTypeEnum::DirectId) {
            if (empty($this->serviceIds)) {
                throw new \InvalidArgumentException('serviceIds must be provided when selectionType is DirectId');
            }
        }

    }
}
