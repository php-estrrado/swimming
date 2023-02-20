<div>
    <table id="coach" class="coach-table table table-striped table-bordered w-100 text-nowrap">
        <thead>
            <tr>
                <th class="wd-15p notexport">Select</th>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Name</th>
                <th class="wd-20p">Phone</th>
                <th class="wd-10p">Email</th>
                <th class="wd-10p">Registered On</th>
                <th class="wd-25p text-center notexport action-btn">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($coaches) {
                $slno = 1;
                foreach ($coaches as $row) {
                    $na = "N/A";
                    if($row->active == 1){ $active = "Active"; $checked = 'checked="checked"'; }else if ($row->active == 0){ $active = "Inactive"; $checked = ""; }
                    ?>
                    <tr class="dtrow" id="dtrow-<?php echo $row->user_id; ?>">
                        <td></td>
                        <td>{{$row->user_id}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{date("d F Y",strtotime($row->created_at))}}</td>
                        <td class="text-center">
                            <button id="coachResBtn-{{$row->user_id}}" class="btn btn-sm btn-success coachResBtn"><i class="fas fa-trash-restore"></i> Restore</button>
                        </td>
                    </tr>
                    <?php
                    $slno++;
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="wd-15p search-by">Search By:</th>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Name</th>
                <th class="wd-20p">Phone</th>
                <th class="wd-10p">Email</th>
                <th class="wd-10p text-center action-search">Regitered On</th>
                <th class="wd-25p text-center action-search"></th>
            </tr>
        </tfoot>
    </table>
    {{ csrf_field() }}
    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
</div>
<script src="{{asset('public/bizzadmin/assets/js/datatable/coach-datatable.js')}}"></script>
