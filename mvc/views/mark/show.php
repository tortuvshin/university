<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("dashboard/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_mark')?></li>
        </ol>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12"></div>
        </div>
    </div>
</div>
<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
            </div>
        </div>
    </div>
</div>

<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID == 0) {
            $('#hide-table').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('mark/mark_list')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>   