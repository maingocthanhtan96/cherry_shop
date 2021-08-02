<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:00:29
 */

/**
 * @OA\Get(
 *     path="/product-rejects",
 *     tags={"ProductReject"},
 *     summary="List ProductReject",
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
 *     path="/product-rejects",
 *     tags={"ProductReject"},
 *     summary="Create ProductReject",
 *     security={{"authApi":{}}},
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id"},
 *                  @OA\Property(property="total", type="INT", default="NULL", example="8750", description=""),
     *                  @OA\Property(property="price", type="FLOAT", default="NULL", example="6598.34", description=""),
     *                  @OA\Property(property="note", type="TEXT", default="NULL", example="Recusandae molestiae qui provident nemo enim. Sint sapiente perspiciatis fuga voluptas earum. Laboriosam voluptatibus nam hic est eaque adipisci. Quo enim qui quos aut sunt.", description=""),
 *                  x="{{SWAGGER_PROPERTY_JSON_CONTENT_NOT_DELETE_THIS_LINE}}"
 *              )
 *          )
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 * @OA\Get(
 *     path="/product-rejects/{id}",
 *     tags={"ProductReject"},
 *     summary="Edit ProductReject",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Put(
 *     path="/product-rejects/{id}",
 *     tags={"ProductReject"},
 *     summary="Update ProductReject",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id"},
 *                  @OA\Property(property="total", type="INT", default="NULL", example="8750", description=""),
     *                  @OA\Property(property="price", type="FLOAT", default="NULL", example="6598.34", description=""),
     *                  @OA\Property(property="note", type="TEXT", default="NULL", example="Recusandae molestiae qui provident nemo enim. Sint sapiente perspiciatis fuga voluptas earum. Laboriosam voluptatibus nam hic est eaque adipisci. Quo enim qui quos aut sunt.", description=""),
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
 *     path="/product-rejects/{id}",
 *     tags={"ProductReject"},
 *     summary="Delete ProductReject",
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
 *     title="ProductReject",
 *     required={"id"},
 * )
 */
class ProductReject
{
    /**
     * @OA\Property(property="id", type="BIGINT", description="AUTO_INCREMENT")
     */

    /**
     * <###> @OA\Property(property="total", type="INT", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="price", type="FLOAT", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="note", type="TEXT", default="NULL", description="")
     */

    //{{SWAGGER_PROPERTY_NOT_DELETE_THIS_LINE}}

    /**
     * @OA\Property(property="created_at", type="TIMESTAMP", default="NULL", description="")
     */

    /**
     * @OA\Property(property="updated_at", type="TIMESTAMP", default="NULL", description="")
     */

    /**
     * @OA\Property(property="deleted_at", type="TIMESTAMP", default="NULL", description="")
     */
}
