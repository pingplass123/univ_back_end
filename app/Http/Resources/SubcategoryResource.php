<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'catagoriesID' => $this->catagoriesID,
            'id' => $this->id,
            'sub_name' => $this->sub_name,
            'description' => $this->description,
            'urlPhoto' => $this->urlPhoto,
        ];
    }
}