<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OffreEmploi;
use Illuminate\Http\Request;
use Validator;
use Ramsey\Uuid\Uuid;
use DB;
use Illuminate\Support\Str;
use App\Http\Resources\OffreEmploiResource;
class OffreController extends Controller
{
    public function GetAllOffres(Request $request){
        $user = $request->user();
        $offres = OffreEmploi::where('creche_id',$user->id)->paginate(PAGINATE_COUNT);
        if($offres->count() <1){
            $message = "قائمة عروض العمل فارغة";
            return $this->sendError($message);
        }
        $offres = OffreEmploiResource::collection($offres)->response()->getData();
        return Response(['data' => $offres],200);
    }   

    public function ShowOffre(Request $request,$uuid){
        $user = $request->user();
        $offre = OffreEmploi::where('uuid',$uuid)->where('creche_id',$user->id)->with('emploi')->first();
        if(!$offre){
            $message = "هذا العرض غير موجود ";
            return $this->sendError($message);
        }
        $offre = new OffreEmploiResource($offre);
        return Response(['data' => $offre],200);
    }
    public function StopOffre(Request $request,$uuid){
        $user = $request->user();
        $offre = OffreEmploi::where('uuid',$uuid)->where('creche_id',$user->id)->with('emploi')->first();
        if(!$offre){
            $message = "هذا العرض غير موجود ";
            return $this->sendError($message);
        }
        $offre->is_active = 0;
        $offre->save();
        $status = 200;
        $message = "تمت توقيف عرض العمل بنجاح بنجاح";

        return $this->sendResponse($status, $message);
    }
    public function AddOffre(Request $request){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'emploi_id' => 'required|exists:emplois,id',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'degre_etude' => 'required',
            'experience' => 'required',
            'phone' => 'required',
        ]);
        

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $offre = OffreEmploi::create([
                'uuid' => (string) Uuid::uuid4(),
                'emploi_id' => $request->emploi_id,
                'wilaya_id' => $request->wilaya_id,
                'commune_id' => $request->commune_id,
                'phone' => $request->phone,
                'degre_etude' => $request->degre_etude,
                'experience' => $request->experience,
                'other_emploi' => $request->emploi_id == 31 ? $request->other_emploi : '',
                'creche_id'  => $user->id
            ]);
            
            
            $status = 200;
            $message = "تمت اضافة عرض العمل بنجاح";

            return $this->sendResponse($status, $message);
     } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
    } 
        

    }

    public function UpdateOffre(Request $request,$uuid){
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'emploi_id' => 'required|exists:emplois,id',
            'wilaya_id' => 'required',
            'commune_id' => 'required',
            'degre_etude' => 'required',
            'experience' => 'required',
            'phone' => 'required',
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try {
            $offre = OffreEmploi::where('creche_id',$user->id)->where('uuid',$uuid)->first();
            if(!$offre){
                $message = "هذا العرض غير موجود ";
                return $this->sendError($message);
            }
            $offre->update([
                'emploi_id' => $request->emploi_id,
                'wilaya_id' => $request->wilaya_id,
                'commune_id' => $request->commune_id,
                'phone' => $request->phone,
                'degre_etude' => $request->degre_etude,
                'experience' => $request->experience,
                'other_emploi' => $request->emploi_id == 31 ? $request->other_emploi : '',
            ]);
            
            
            $status = 200;
            $message = "تم تعديل عرض العمل بنجاح";

            return $this->sendResponse($status, $message);
     } catch (\Throwable $th) {
        return Response(['data' => 'Unauthorized'],401);
        } 
        

    }


    public function ShowAllOffres(){
        $offres = OffreEmploi::where('is_active',1)->with('creche')->with('emploi')->paginate(PAGINATE_COUNT);
        if($offres->count() <1){
            $message = "قائمة عروض العمل فارغة";
            return $this->sendError($message);
        }
        $offres = OffreEmploiResource::collection($offres)->response()->getData();
        return Response(['data' => $offres],200);
    }
    public function ShowOffreToUser(Request $request,$uuid){
        $offre = OffreEmploi::where('uuid',$uuid)->with('emploi')->first();
        if(!$offre){
            $message = "هذا العرض غير موجود ";
            return $this->sendError($message);
        }
        $offre = new OffreEmploiResource($offre);
        return Response(['data' => $offre],200);
    }

    public function SearchOffre(Request $request){
        $type = $request->type;
        $wilaya = $request->wilaya;
        $commune = $request->commune;
        $query = OffreEmploi::query();
        $query->where('is_active',1);
        
        if (!empty($type)) {
            $query->where('emploi_id',$type);         
        }
        if (!empty($wilaya)) {
            $query->where('wilaya_id', $wilaya);
        }
        if (!empty($commune)) {
            $query->where('commune_id', $commune);
        }
        $creches = $query->paginate(PAGINATE_COUNT);

        $offres = $query->with('creche')->with('emploi')->paginate(PAGINATE_COUNT);

        if(!$offres || count($offres) < 1){
            $message = "هذا العرض غير موجود ";
            return $this->sendError($message);
        }
        $offres = OffreEmploiResource::collection($offres)->response()->getData();
        return Response(['data' => $offres],200);
    }

    
    public function sendError($error, $errorMessages = [], $code = 204)
    {
    	$response = [
            'success' => false,
            'status'    => $code,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response);
    }
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'status'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
}
