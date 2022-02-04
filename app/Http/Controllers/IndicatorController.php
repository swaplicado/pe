<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_type;
use App\Models\Indicator;
use App\Models\Indicator_status;
use App\Models\Year;
use App\User;
use App\Models\Department;
use App\Models\Indicator_status_log;
use App\Models\Indicator_score_log;
use DB;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->id();
        $Acalif = [];
        $datas = Indicator::where('is_deleted',0)->where('user_id',$user)->get();
        $datas->each(function($datas){
            $datas->data_type;
            $datas->indicator_status;
        });
        $ultimo_comentario = DB::table('indicator_status_log')
                                        ->where('user_id',$user)
                                        ->orderBy('updated_at','desc')
                                        ->get();
        $calificaciones = DB::table('indicator_scores_log')
                                        ->join('indicators','indicators.id_indicator','=','indicator_scores_log.indicator_id')
                                        ->where('indicators.user_id',$user)
                                        ->get();

        for( $i = 0 ; count($calificaciones) > $i ; $i++ ){
            $Acalif[$calificaciones[$i]->indicator_id] = $calificaciones[$i]->score;
        }
        if(count($calificaciones) > 0){
            $have_score = 1;
        }else{
            $have_score = 0;
        }
        if(count($ultimo_comentario) > 0){
            $comentario = 1;
        }else{
            $comentario = 0;
        }
        
        return view('indicators.index', compact('datas'))->with('user',$user)->with('ultimo_comentario',$ultimo_comentario)->with('comentario',$comentario)->with('calif',$Acalif)->with('have_score',$have_score);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_types = Data_type::where('is_delete','0')->orderBy('name','ASC')->pluck('id_data_type','name');
        $year = Year::where('is_deleted','0')->orderBy('year','ASC')->pluck('id_year','year');
        return view('indicators.create', compact('data_types'))->with('years',$year);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $indicator = Indicator::create([
            'user_id' => auth()->id(),
            'year_id' => '1',
            'name' => $request->name,
            'description' => $request->description,
            'unit_measurement' => $request->unit_measurement,
            'data_type_id' => $request->data_type_id,
            'minimum_value' => $request->minimum_value,
            'expected_value' => $request->expected_value,
            'excellent_value' => $request->excellent_value,
            'weighing' => $request->weighing,
            'indicator_status_id' => 1,
            'is_deleted' => 0,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id()
        ]);
        
        $indicator->save();
        return redirect('indicator')->with('mensaje','Indicador fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_types = Data_type::where('is_delete','0')->orderBy('name','ASC')->pluck('id_data_type','name');
        $year = Year::where('is_deleted','0')->orderBy('year','ASC')->pluck('id_year','year');
        $data = Indicator::findOrFail($id);
  
        return view('indicators.edit', compact('data_types'))->with('years',$year)->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $indicator = Indicator::findOrFail($id);
        $indicator->name = $request->name;
        $indicator->description = $request->description;
        $indicator->unit_measurement = $request->unit_measurement;
        $indicator->data_type_id = $request->data_type_id;
        $indicator->minimum_value = $request->minimum_value;
        $indicator->expected_value = $request->expected_value;
        $indicator->excellent_value = $request->excellent_value;
        $indicator->weighing = $request->weighing;
        $indicator->indicator_status_id = 1;
        $indicator->is_deleted = 0;
        $indicator->updated_by = auth()->id();

        $indicator->save();

        return redirect('indicator')->with('mensaje','Indicador fue editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($request->ajax()) {
            $indicator = Indicator::find($id);
            $indicator->is_deleted = 1;
            $indicator->save();
            return response()->json(['mensaje' => 'ok']);
        } else {
            abort(404);
        }
    }

    public function send_to_aprove(Request $request){
        $datas = Indicator::where('is_deleted',0)->where('user_id',$request->id_empleado)->get();
        for($i = 0 ; count($datas) > $i ; $i++){
            $indicator = Indicator::findOrFail($datas[$i]->id_indicator);
            $indicator->indicator_status_id = 2; 
            $indicator->save(); 
        }
        $status_log = new Indicator_status_log();
        $status_log->indicator_status_id = 2;
        $status_log->user_id = $request->id_empleado;
        //se queda en duro por el momento
        $status_log->year_id = 1;
        $status_log->created_by = auth()->id();
        $status_log->updated_by = auth()->id();
        $status_log->save();
        $data = 1;
        return response()->json(array($data));   
    }

    public function sendscore_to_aprove(Request $request){
        $datas = Indicator::where('is_deleted',0)->where('user_id',$request->id_empleado)->get();
        for($i = 0 ; count($datas) > $i ; $i++){
            $indicator = Indicator::findOrFail($datas[$i]->id_indicator);
            $indicator->indicator_status_id = 5; 
            $indicator->save(); 
        }
        $status_log = new Indicator_status_log();
        $status_log->indicator_status_id = 5;
        $status_log->user_id = $request->id_empleado;
        //se queda en duro por el momento
        $status_log->year_id = 1;
        $status_log->created_by = auth()->id();
        $status_log->updated_by = auth()->id();
        $status_log->save();
        $data = 1;
        return response()->json(array($data));   
    }


    public function aprove_indicator(Request $request){
        $datas = Indicator::where('is_deleted',0)->where('user_id',$request->id_empleado)->get();
        for($i = 0 ; count($datas) > $i ; $i++){
            $indicator = Indicator::findOrFail($datas[$i]->id_indicator);
            $indicator->indicator_status_id = 3; 
            $indicator->save(); 
        }
        $status_log = new Indicator_status_log();
        $status_log->indicator_status_id = 3;
        $status_log->user_id = $request->id_empleado;
        //se queda en duro por el momento
        $status_log->year_id = 1;
        $status_log->comment = $request->comentario;
        $status_log->created_by = auth()->id();
        $status_log->updated_by = auth()->id();
        $status_log->save();
        $data = 1;
        return response()->json(array($data));    
    }

    public function refuse_indicator(Request $request){
        $datas = Indicator::where('is_deleted',0)->where('user_id',$request->id_empleado)->get();
        for($i = 0 ; count($datas) > $i ; $i++){
            $indicator = Indicator::findOrFail($datas[$i]->id_indicator);
            $indicator->indicator_status_id = 4; 
            $indicator->save(); 
        }
        $status_log = new Indicator_status_log();
        $status_log->indicator_status_id = 4;
        $status_log->user_id = $request->id_empleado;
        //se queda en duro por el momento
        $status_log->year_id = 1;
        $status_log->comment = $request->comentario;
        $status_log->created_by = auth()->id();
        $status_log->updated_by = auth()->id();
        $status_log->save();
        $data = 1;
        return response()->json(array($data));
    }

    public function aprove_score(Request $request){
        $datas = Indicator::where('is_deleted',0)->where('user_id',$request->id_empleado)->get();
        for($i = 0 ; count($datas) > $i ; $i++){
            $indicator = Indicator::findOrFail($datas[$i]->id_indicator);
            $indicator->indicator_status_id = 6; 
            $indicator->save(); 
        }
        $status_log = new Indicator_status_log();
        $status_log->indicator_status_id = 6;
        $status_log->user_id = $request->id_empleado;
        //se queda en duro por el momento
        $status_log->year_id = 1;
        $status_log->comment = $request->comentario;
        $status_log->created_by = auth()->id();
        $status_log->updated_by = auth()->id();
        $status_log->save();
        $data = 1;
        return response()->json(array($data));    
    }

    public function refuse_score(Request $request){
        $datas = Indicator::where('is_deleted',0)->where('user_id',$request->id_empleado)->get();
        for($i = 0 ; count($datas) > $i ; $i++){
            $indicator = Indicator::findOrFail($datas[$i]->id_indicator);
            $indicator->indicator_status_id = 7; 
            $indicator->save(); 
        }
        $status_log = new Indicator_status_log();
        $status_log->indicator_status_id = 7;
        $status_log->user_id = $request->id_empleado;
        //se queda en duro por el momento
        $status_log->year_id = 1;
        $status_log->comment = $request->comentario;
        $status_log->created_by = auth()->id();
        $status_log->updated_by = auth()->id();
        $status_log->save();
        $data = 1;
        return response()->json(array($data));
    }

    public function list_indicators_to_aprove(){
        $id_user = auth()->id();
        $user = User::findOrFail($id_user);
        $departamentos = Department::where('department_id',$user->department_id)->where('is_delete',0)->get();
        $Adept = [];
        
        for( $i = 0 ; count($departamentos) > $i ; $i++){
            $Adept[$i] = $departamentos[$i]->id_department;
        }

        $datas = DB::table('indicators')
                        ->join('users','users.id','=','indicators.user_id')
                        ->join('departments','departments.id_department','=','users.department_id')
                        ->join('sys_data_type','sys_data_type.id_data_type','=','indicators.data_type_id')
                        ->where('indicators.indicator_status_id',2)
                        ->whereIn('users.department_id',$Adept)
                        ->select('indicators.id_indicator AS idI','indicators.user_id AS idU','indicators.name AS nameI','indicators.description AS description','indicators.unit_measurement AS unit','sys_data_type.name AS nameD','indicators.minimum_value AS minimum','indicators.expected_value AS expected','indicators.excellent_value AS excelent', 'weighing AS weig')
                        ->get();
        //dd($datas);
        $empleados = DB::table('users')
                            ->join('departments','departments.id_department','=','users.department_id')
                            ->whereIn('users.department_id',$Adept)
                            ->select('users.id AS idE','users.full_name AS nombreE','departments.name AS nombreD')
                            ->get();
        return view('indicators.aprove', compact('datas'))->with('user',$user)->with('empleados',$empleados);    
    }

    public function score_indicator($id){
        $data = Indicator::findOrFail($id);
  
        return view('indicators.score', compact('data'));    
    }

    public function guardar_score(Request $request, $id){

        $id_score = DB::table('indicator_scores_log')
                                ->where('indicator_id',$id)
                                ->get();
        if(count($id_score)){
            Indicator_score_log::destroy($id_score[0]->id_score);
        }

        $score = new Indicator_score_log();

        $score->indicator_id = $id;
        $score->score = $request->score;
        $score->comment = $request->comentario;
        $score->created_by = auth()->id();
        $score->updated_by = auth()->id();
        $score->save();
        
        return redirect('indicator')->with('mensaje','Indicador calificado con éxito');
    }

    public function list_score_to_aprove(){
        $id_user = auth()->id();
        $Acalif = [];
        $Acomen = [];
        $user = User::findOrFail($id_user);
        $departamentos = Department::where('department_id',$user->department_id)->where('is_delete',0)->get();
        $Adept = [];
        
        for( $i = 0 ; count($departamentos) > $i ; $i++){
            $Adept[$i] = $departamentos[$i]->id_department;
        }

        $datas = DB::table('indicators')
                        ->join('users','users.id','=','indicators.user_id')
                        ->join('departments','departments.id_department','=','users.department_id')
                        ->join('sys_data_type','sys_data_type.id_data_type','=','indicators.data_type_id')
                        ->where('indicators.indicator_status_id',5)
                        ->whereIn('users.department_id',$Adept)
                        ->select('indicators.id_indicator AS idI','indicators.user_id AS idU','indicators.name AS nameI','indicators.description AS description','indicators.unit_measurement AS unit','sys_data_type.name AS nameD','indicators.minimum_value AS minimum','indicators.expected_value AS expected','indicators.excellent_value AS excelent', 'weighing AS weig')
                        ->get();
        //dd($datas);
        $empleados = DB::table('users')
                            ->join('departments','departments.id_department','=','users.department_id')
                            ->whereIn('users.department_id',$Adept)
                            ->select('users.id AS idE','users.full_name AS nombreE','departments.name AS nombreD')
                            ->get();
        
        $calificaciones = DB::table('indicator_scores_log')
                            ->join('indicators','indicators.id_indicator','=','indicator_scores_log.indicator_id')
                            ->get();

        for( $i = 0 ; count($calificaciones) > $i ; $i++ ){
            $Acalif[$calificaciones[$i]->indicator_id] = $calificaciones[$i]->score;
            $Acomen[$calificaciones[$i]->indicator_id] = $calificaciones[$i]->comment;
        }
        if(count($calificaciones) > 0){
            $have_score = 1;
        }else{
            $have_score = 0;
        }
        return view('indicators.scoreaprove', compact('datas'))->with('user',$user)->with('empleados',$empleados)->with('calif',$Acalif)->with('comen',$Acomen)->with('have_score',$have_score);    
    }

    public function indicator_list(){
        $id_user = auth()->id();
        $Acalif = [];
        $Acomen = [];
        $user = User::findOrFail($id_user);
        $departamentos = Department::where('department_id',$user->department_id)->where('is_delete',0)->get();
        $Adept = [];
        
        for( $i = 0 ; count($departamentos) > $i ; $i++){
            $Adept[$i] = $departamentos[$i]->id_department;
        }

        $datas = DB::table('indicators')
                        ->join('users','users.id','=','indicators.user_id')
                        ->join('departments','departments.id_department','=','users.department_id')
                        ->join('sys_data_type','sys_data_type.id_data_type','=','indicators.data_type_id')
                        ->whereIn('users.department_id',$Adept)
                        ->select('indicators.id_indicator AS idI','indicators.user_id AS idU','indicators.name AS nameI','indicators.description AS description','indicators.unit_measurement AS unit','sys_data_type.name AS nameD','indicators.minimum_value AS minimum','indicators.expected_value AS expected','indicators.excellent_value AS excelent', 'weighing AS weig')
                        ->get();
        //dd($datas);
        $empleados = DB::table('users')
                            ->join('departments','departments.id_department','=','users.department_id')
                            ->whereIn('users.department_id',$Adept)
                            ->select('users.id AS idE','users.full_name AS nombreE','departments.name AS nombreD')
                            ->get();
        
        $calificaciones = DB::table('indicator_scores_log')
                            ->join('indicators','indicators.id_indicator','=','indicator_scores_log.indicator_id')
                            ->get();
        $tablaCalif = DB::table('config_indicators_weighting_scores')->get();

        $tablaCalifTot = DB::table('config_total_weighting_scores')->get();

        for( $i = 0 ; count($calificaciones) > $i ; $i++ ){
            $Acalif[$calificaciones[$i]->indicator_id] = $calificaciones[$i]->score;
            $Acomen[$calificaciones[$i]->indicator_id] = $calificaciones[$i]->comment;
        }
        if(count($calificaciones) > 0){
            $have_score = 1;
        }else{
            $have_score = 0;
        }
        return view('indicators.list', compact('datas'))->with('user',$user)->with('empleados',$empleados)->with('calif',$Acalif)->with('comen',$Acomen)->with('have_score',$have_score)->with('tablaCalif',$tablaCalif)->with('tablaCalifTot',$tablaCalifTot);    
    }
}
