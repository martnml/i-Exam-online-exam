<div class="row">
    <div class="col-sm-5">
        <div class="dataTables_info" id="userListing_info" role="status" aria-live="polite">Showing 1 to
            <?php echo  mysqli_num_rows($result7).'&nbsp; of &nbsp;'.mysqli_num_rows($result7) .' &nbsp; entries &nbsp;'; ?>
        </div>
    </div>
    <div class="col-sm-7" style="position:relative;margin-left:82%; margin-top:-58px;">
        <div class="dataTables_paginate paging_simple_numbers" id="userListing_paginate">
            <ul class="pagination">
                <li class="paginate_button previous disabled" id="userListing_previous"><a href="#"
                        aria-controls="userListing" data-dt-idx="0" tabindex="0">Previous</a></li>
                <li class="paginate_button active"><a href="#" aria-controls="userListing" data-dt-idx="1"
                        tabindex="0">1</a></li>
                <li class="paginate_button next disabled" id="userListing_next"><a href="#" aria-controls="userListing"
                        data-dt-idx="2" tabindex="0">Next</a></li>
            </ul>
        </div>
    </div>
</div>