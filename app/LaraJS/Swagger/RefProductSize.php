<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:05:47
 */

/**
 * @OA\Schema(
 *     type="object",
 *     title="RefProductSize",
 *     required={"id", "size_id", "product_id"},
 *     description="belongsToMany",
 * )
 */
class RefProductSize
{
    /**
     * @OA\Property(property="id", type="BIGINT", description="AUTO_INCREMENT")
     */

    /**
     * @OA\Property(property="size_id", default="NONE", description="belongsToMany")
     * @var Size
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
