<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 */

/**
 * @OA\Get(
 *     path="/products",
 *     tags={"Product"},
 *     summary="List Product",
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
 *     path="/products",
 *     tags={"Product"},
 *     summary="Create Product",
 *     security={{"authApi":{}}},
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id", "code", "name"},
 *                  @OA\Property(property="code", type="VARCHAR", default="NONE", example="Christopher Skiles", description=""),
     *                  @OA\Property(property="name", type="VARCHAR", default="NONE", example="Kathlyn Green", description=""),
     *                  @OA\Property(property="image", type="VARCHAR", default="NULL", example="Dovie Wunsch", description=""),
     *                  @OA\Property(property="description", type="TEXT", default="NULL", example="Exercitationem laborum nobis rem ad esse commodi corporis. Eaque tempora dolores harum. Accusamus ut quod officia fuga. Quasi et aut dolor veritatis esse vel voluptatum. Nihil tempora et fugiat veritatis ullam.", description=""),
     *                  @OA\Property(property="stock_in", type="INT", default="NULL", example="6414", description=""),
     *                  @OA\Property(property="stock_out", type="INT", default="NULL", example="2789", description=""),
     *                  @OA\Property(property="inventory", type="INT", default="NULL", example="5639", description=""),
     *                  @OA\Property(property="price", type="FLOAT", default="NULL", example="7022.09", description=""),
     *                  @OA\Property(property="discount", type="INT", default="NULL", example="6449", description=""),
     *                  @OA\Property(property="status", type="BOOLEAN", default="1", example="0", description=""),
 *                  x="{{SWAGGER_PROPERTY_JSON_CONTENT_NOT_DELETE_THIS_LINE}}"
 *              )
 *          )
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 * @OA\Get(
 *     path="/products/{id}",
 *     tags={"Product"},
 *     summary="Edit Product",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Put(
 *     path="/products/{id}",
 *     tags={"Product"},
 *     summary="Update Product",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id", "code", "name"},
 *                  @OA\Property(property="code", type="VARCHAR", default="NONE", example="Christopher Skiles", description=""),
     *                  @OA\Property(property="name", type="VARCHAR", default="NONE", example="Kathlyn Green", description=""),
     *                  @OA\Property(property="image", type="VARCHAR", default="NULL", example="Dovie Wunsch", description=""),
     *                  @OA\Property(property="description", type="TEXT", default="NULL", example="Exercitationem laborum nobis rem ad esse commodi corporis. Eaque tempora dolores harum. Accusamus ut quod officia fuga. Quasi et aut dolor veritatis esse vel voluptatum. Nihil tempora et fugiat veritatis ullam.", description=""),
     *                  @OA\Property(property="stock_in", type="INT", default="NULL", example="6414", description=""),
     *                  @OA\Property(property="stock_out", type="INT", default="NULL", example="2789", description=""),
     *                  @OA\Property(property="inventory", type="INT", default="NULL", example="5639", description=""),
     *                  @OA\Property(property="price", type="FLOAT", default="NULL", example="7022.09", description=""),
     *                  @OA\Property(property="discount", type="INT", default="NULL", example="6449", description=""),
     *                  @OA\Property(property="status", type="BOOLEAN", default="1", example="0", description=""),
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
 *     path="/products/{id}",
 *     tags={"Product"},
 *     summary="Delete Product",
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
 *     title="Product",
 *     required={"id", "code", "name"},
 * )
 */
class Product
{
    /**
     * @OA\Property(property="id", type="BIGINT", description="AUTO_INCREMENT")
     */

    /**
     * <###> @OA\Property(property="code", type="VARCHAR", default="NONE", description="")
     */

    /**
     * <###> @OA\Property(property="name", type="VARCHAR", default="NONE", description="")
     */

    /**
     * <###> @OA\Property(property="image", type="VARCHAR", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="description", type="TEXT", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="stock_in", type="INT", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="stock_out", type="INT", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="inventory", type="INT", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="price", type="FLOAT", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="discount", type="INT", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="status", type="BOOLEAN", default="1", description="")
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
