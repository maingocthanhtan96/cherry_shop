<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-05 21:05:22
 */

/**
 * @OA\Get(
 *     path="/product-details",
 *     tags={"ProductDetail"},
 *     summary="List ProductDetail",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(
 *          name="search",
 *          in="query",
 *          @OA\Schema (type="string")
 *     ),
 *     @OA\Parameter(
 *          name="limit",
 *          in="query",
 *          @OA\Schema (type="integer")
 *     ),
 *     @OA\Parameter(
 *          name="ascending",
 *          in="query",
 *          description="0: asc, 1: desc",
 *          @OA\Schema (type="integer", default=1)
 *     ),
 *     @OA\Parameter(
 *          name="page",
 *          in="query",
 *          @OA\Schema (type="integer", default=1)
 *     ),
 *     @OA\Parameter(
 *          name="orderBy",
 *          in="query",
 *          description="column order by",
 *          @OA\Schema (type="string", default="updated_at")
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Post(
 *     path="/product-details",
 *     tags={"ProductDetail"},
 *     summary="Create ProductDetail",
 *     security={{"authApi":{}}},
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id", "price", "amount", "product_id", "size_id"},
 *                  @OA\Property(property="price", type="VARCHAR", default="NONE", example="Lavonne Grant IV", description=""),
     *                  @OA\Property(property="amount", type="INT", default="NONE", example="8767", description=""),
 *                  @OA\Property(property="product_id", type="BIGINT", default="NONE", example="1", description="hasMany"),
 *                  @OA\Property(property="size_id", type="BIGINT", default="NONE", example="1", description="hasMany"),
 *                  x="{{SWAGGER_PROPERTY_JSON_CONTENT_NOT_DELETE_THIS_LINE}}"
 *              )
 *          )
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 * @OA\Get(
 *     path="/product-details/{id}",
 *     tags={"ProductDetail"},
 *     summary="Edit ProductDetail",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Put(
 *     path="/product-details/{id}",
 *     tags={"ProductDetail"},
 *     summary="Update ProductDetail",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id", "price", "amount", "product_id", "size_id"},
 *                  @OA\Property(property="price", type="VARCHAR", default="NONE", example="Lavonne Grant IV", description=""),
     *                  @OA\Property(property="amount", type="INT", default="NONE", example="8767", description=""),
 *                  @OA\Property(property="product_id", type="BIGINT", default="NONE", example="1", description="hasMany"),
 *                  @OA\Property(property="size_id", type="BIGINT", default="NONE", example="1", description="hasMany"),
 *                  x="{{SWAGGER_PROPERTY_JSON_CONTENT_NOT_DELETE_THIS_LINE}}"
 *              )
 *          )
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Delete(
 *     path="/product-details/{id}",
 *     tags={"ProductDetail"},
 *     summary="Delete ProductDetail",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 */

/**
 * @OA\Schema(
 *     type="object",
 *     title="ProductDetail",
 *     required={"id", "price", "amount", "product_id", "size_id"},
 * )
 */
class ProductDetail
{
    /**
     * @OA\Property(property="id", type="BIGINT", description="AUTO_INCREMENT")
     */

    /**
     * <###> @OA\Property(property="price", type="VARCHAR", default="NONE", description="")
     */

    /**
     * <###> @OA\Property(property="amount", type="INT", default="NONE", description="")
     */

    /**
     * @OA\Property(property="product_id", default="NONE", description="hasMany")
     * @var Product
     */

    /**
     * @OA\Property(property="size_id", default="NONE", description="hasMany")
     * @var Size
     */

    //{{SWAGGER_PROPERTY_NOT_DELETE_THIS_LINE}}

    /**
     * @OA\Property(property="created_at", type="TIMESTAMP", default="NULL", description="")
     */

    /**
     * @OA\Property(property="updated_at", type="TIMESTAMP", default="NULL", description="")
     */

    
}
