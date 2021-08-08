<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:02:10
 */

/**
 * @OA\Get(
 *     path="/members",
 *     tags={"Member"},
 *     summary="List Member",
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
 *     path="/members",
 *     tags={"Member"},
 *     summary="Create Member",
 *     security={{"authApi":{}}},
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id", "name"},
 *                  @OA\Property(property="code", type="VARCHAR", default="NULL", example="Simeon Carter", description=""),
     *                  @OA\Property(property="name", type="VARCHAR", default="NONE", example="Melvina Graham", description=""),
     *                  @OA\Property(property="sns_link", type="VARCHAR", default="NULL", example="Dr. Andres Botsford", description=""),
     *                  @OA\Property(property="is_block", type="BOOLEAN", default="0", example="0", description=""),
 *                  @OA\Property(property="phone", type="VARCHAR", default="NULL", example="Dr. Lela Kirlin", description=""),
 *                  x="{{SWAGGER_PROPERTY_JSON_CONTENT_NOT_DELETE_THIS_LINE}}"
 *              )
 *          )
 *     ),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 * @OA\Get(
 *     path="/members/{id}",
 *     tags={"Member"},
 *     summary="Edit Member",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\Response(response="200", ref="#/components/responses/OK"),
 *     @OA\Response(response="404", ref="#/components/responses/NotFound"),
 *     @OA\Response(response="500", ref="#/components/responses/Error"),
 * )
 *
 * @OA\Put(
 *     path="/members/{id}",
 *     tags={"Member"},
 *     summary="Update Member",
 *     security={{"authApi":{}}},
 *     @OA\Parameter(ref="#/components/parameters/id"),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema (
 *                  required={"id", "name"},
 *                  @OA\Property(property="code", type="VARCHAR", default="NULL", example="Simeon Carter", description=""),
     *                  @OA\Property(property="name", type="VARCHAR", default="NONE", example="Melvina Graham", description=""),
     *                  @OA\Property(property="sns_link", type="VARCHAR", default="NULL", example="Dr. Andres Botsford", description=""),
     *                  @OA\Property(property="is_block", type="BOOLEAN", default="0", example="0", description=""),
 *                  @OA\Property(property="phone", type="VARCHAR", default="NULL", example="Dr. Lela Kirlin", description=""),
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
 *     path="/members/{id}",
 *     tags={"Member"},
 *     summary="Delete Member",
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
 *     title="Member",
 *     required={"id", "name"},
 * )
 */
class Member
{
    /**
     * @OA\Property(property="id", type="BIGINT", description="AUTO_INCREMENT")
     */

    /**
     * <###> @OA\Property(property="code", type="VARCHAR", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="name", type="VARCHAR", default="NONE", description="")
     */

    /**
     * <###> @OA\Property(property="sns_link", type="VARCHAR", default="NULL", description="")
     */

    /**
     * <###> @OA\Property(property="is_block", type="BOOLEAN", default="0", description="")
     */

    /**
     * <###> @OA\Property(property="phone", type="VARCHAR", default="NULL", description="")
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
