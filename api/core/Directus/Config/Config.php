<?php

namespace Directus\Config;

use Directus\Collection\Collection;
use Directus\Util\ArrayUtils;

class Config extends Collection implements ConfigInterface
{
    /**
     * Get a list of published statuses
     *
     * @param array $statusMapping
     *
     * @return array
     */
    public function getPublishedStatuses($statusMapping = [])
    {
        $visibleStatus = $this->getStatuses('published', $statusMapping);

        if (empty($visibleStatus) && defined('STATUS_ACTIVE_NUM')) {
            $visibleStatus[] = STATUS_ACTIVE_NUM;
        }

        return $visibleStatus;
    }

    /**
     * Get a list of hard-deleted statuses
     *
     * @param array $statusMapping
     *
     * @return array
     */
    public function getDeletedStatuses($statusMapping = [])
    {
        $visibleStatus = $this->getStatuses('hard_delete', $statusMapping);

        if (empty($visibleStatus) && defined('STATUS_DELETED_NUM')) {
            $visibleStatus[] = STATUS_DELETED_NUM;
        }

        return $visibleStatus;
    }

    /**
     * Get all statuses value
     *
     * @param array $statusMapping
     *
     * @return array
     */
    public function getAllStatuses($statusMapping = [])
    {
        if (empty($statusMapping)) {
            $statusMapping = $this->getGlobalStatusMapping();
        }

        $statuses = [];

        foreach ($statusMapping as $value => $status) {
            if (is_array($status)) {
                $statuses[] = $value;
            }
        }

        return $statuses;
    }

    /**
     * The global status mapping
     *
     * @return array
     */
    protected function getGlobalStatusMapping()
    {
        return $this->get('statusMapping', []);
    }

    /**
     * Get statuses list by the given type
     *
     * @param $type
     * @param array $statusMapping
     *
     * @return array
     */
    protected function getStatuses($type, $statusMapping = [])
    {
        if (empty($statusMapping)) {
            $statusMapping = $this->getGlobalStatusMapping();
        }

        $statuses = [];

        foreach ($statusMapping as $value => $status) {
            $isPublished = ArrayUtils::get($status, $type, false);

            if (is_array($status) && $isPublished) {
                $statuses[] = $value;
            }
        }

        return $statuses;
    }
}
