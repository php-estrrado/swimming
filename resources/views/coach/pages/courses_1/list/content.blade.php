<div class="table-responsive">
    <table id="course" class="course-table table table-striped table-bordered w-100 text-nowrap">
        <thead>
            <tr>
                <th class="wd-15p notexport">Select</th>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Course Name</th>
                <th class="wd-20p">Location</th>
                <th class="wd-10p">Total Students</th>
                <th class="wd-10p">Closing Date</th>
                <th class="wd-25p text-center notexport action-btn">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($courses) {
                $slno = 1;
                foreach ($courses as $row) {
                    ?>
                    <tr class="dtrow" id="dtrow-<?php echo $row->regId; ?>">
                        <td></td>
                        <td>{{$row->course_code}}</td>
                        <td>{{$row->course_name}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->students}}</td>
                        <td>{{date('D M Y',strtotime($row->closing_date))}}</td>
                        <td class="text-center">
                            <a href="{{url('/coach/course/'.$row->regId)}}"><button id="courseEditBtn-{{$row->regId}}" class="btn btn-sm btn-primary btn-info studentEditBtn"><i class="fa fa-eye"></i>View</button></a>
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
                <th class="wd-15p">Course Name</th>
                <th class="wd-20p">Location</th>
                <th class="wd-10p">No. of Students</th>
                <th class="wd-10p">Closing Date</th>
                <th class="wd-25p text-center action-search"></th>
            </tr>
        </tfoot>
    </table>
    {{ csrf_field() }}
    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
</div>
<script src="{{asset('public/coach/assets/js/datatable/course-datatable.js')}}"></script>
