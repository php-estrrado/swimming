
<div>
    <table id="location" class="location-table table table-striped table-bordered w-100 text-nowrap">
        <thead>
            <tr>
                <th class="wd-15p notexport">Select</th>
                <th class="wd-15p">Sl No</th>
                <th class="wd-15p">Location Name</th>
                <th class="wd-20p">State</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p text-center notexport action-btn">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($locations) {
                $slno = 1;
                foreach ($locations as $location) {

                    $na = "N/A";
                    if ($location->active == 1) {
                        $active = "Active";
                        $checked = 'checked="checked"';
                    } else if ($location->active == 0) {
                        $active = "Inactive";
                        $checked = "";
                    }
                    ?>
                    <tr class="dtrow" id="dtrow-<?php echo $location->id; ?>">
                        <td></td>
                        <td><?php echo $slno; ?></td>
                        <td><?php echo $location->name; ?></td>
                        <td><?php echo $location->stName; ?></td>
                        <td>
                            <label class="custom-switch">
                                <input id="status-<?php echo $location->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="csd-<?php echo $location->id; ?>">
                                    <?php echo $active; ?>
                                </span>
                            </label>
                        </td>
                        <td class="text-center">
                            {{Form::hidden('stId',$location->stId,['id'=>'stId'])}}
                            <button id="locEditBtn-<?php echo $location->id; ?>" class="btn btn-sm btn-primary btn-edit editBtn"><i class="fa fa-edit"></i> Edit</button>
                            <button id="locDelBtn-<?php echo $location->id; ?>" class="btn btn-sm btn-danger btn-delete locDelBtn"><i class="fa fa-trash"></i> Delete</button>
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
                <th class="wd-15p">Sl No</th>
                <th class="wd-15p">Location Name</th>
                <th class="wd-20p">State</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p text-center action-search"></th>
            </tr>
        </tfoot>
    </table>
    {{ csrf_field() }}
    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
</div>
            
<script src="{{asset('public/bizzadmin/assets/js/datatable/location-datatable.js')}}"></script>
