<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Index Book request",
 *      description="Index Book request body data",
 *      @OA\Xml(
 *     name="IndexBookRequest"
 *     )
 * )
 */
class IndexBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|between:2,191',
            'order' => 'nullable|in:asc,desc',
            'genre_ids' => 'nullable|array|max:4',
            'genre_ids.*' => 'exists:genres,id',
        ];
    }

    /**
     * @OA\Property(
     *    title="Book name",
     *   description="Book name",
     *  example="Baylee"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *    title="Order",
     *   description="Order of book publication year",
     *  example="asc"
     * )
     *
     * @var string
     */
    private $order;

    /**
     * @OA\Property(
     *    title="Genre ids",
     *     description="Genre ids",
     *     type="array",
     *     example={
     *     6, 10
     *     },
     *     @OA\Items(
     *     @OA\Property(property="genre", type="integer", example="1"),
     *     )
     * )
     *
     * @var array
     */
    private $genre;

}
