<?php

namespace Finteger\Guest\Serializers;

use Flarum\Api\Serializer\AbstractSerializer;

class GuestSerializer extends AbstractSerializer
{
    /**
     * The default relations to be included in the serialized response.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Get the default set of serialized attributes for a model.
     *
     * @param object|array $model
     * @return array
     */
    protected function getDefaultAttributes($model)
    {
        return [
            'id' => $model->id,
            'username' => $model->username,
            'email' => $model->email,
        ];
    }
}
