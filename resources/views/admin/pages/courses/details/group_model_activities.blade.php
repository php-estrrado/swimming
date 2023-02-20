@if(isset($assigned) && count($assigned)) 
    <div class="row">
        @foreach($assigned as $row)
            <div class="assigned col-md-6">
                <label class="gr-act-check">{{$row->activity_code}} -- {{$row->activity_name}}
                    {{Form::checkbox('act['.$row->id.']',$row->id,true,['id'=>'gr_act-'.$row->id])}}
                    <span class="checkmark"></span>
                </label>
            </div>
        @endforeach
    </div>
@endif 
@if(isset($unAssigned) && count($unAssigned)) 
    <div class="row"> 
        @foreach($unAssigned as $row)
            <div class="col-md-6">
                <label class="gr-act-check">{{$row->activity_code}} -- {{$row->activity_name}}
                    {{Form::checkbox('act['.$row->id.']',$row->id,false,['id'=>'gr_act-'.$row->id])}}
                    <span class="checkmark"></span>
                </label>
            </div>
        @endforeach
    </div>
@endif 

                    