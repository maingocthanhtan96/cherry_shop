<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:04:24
 */

/**
 * @OA\Schema(
 *     type="object",
 *     title="RefProductColor",
 *     required={"id", "color_id", "product_id"},
 *     description="belongsToMany",
 * )
 */
class RefProductColor
{
    /**
     * @OA\Property(property="id", type="BIGINT", description="AUTO_INCREMENT")
     */

    /**
     * @OA\Property(property="color_id", default="NONE", description="belongsToMany")
     * @var Color
     */

    /**
     * @OA\Property(property="product_id", default="NONE", description="belongsToMany")
     * @var Product
     */

    //{{SWAGGER_PROPERTY_NOT_DELETE_THIS_LINE}}

    /**
     * @OA\Property(property="created_at", type="TIMESTAMP", default="NULL", description="")
     */

    /**
     * @OA\Property(property="updated_at", type="TIMESTAMP", default="NULL", description="")
     */
}
