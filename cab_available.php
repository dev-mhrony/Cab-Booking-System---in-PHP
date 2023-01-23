<!-- Author By: MH RONY
Author Website: https://developerrony.com
Github Link: https://github.com/dev-mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
-->
<!-- Author By: MH RONY
Author Website: https://developerrony.com
Github Link: https://github.com/dev-mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
-->

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5 card rounded-0 card-outline card-purple shadow">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h1 class="display-4 fw-bolder">Available Cabs</h1>
                    <hr>
                </center>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="search" id="search" class="form-control" placeholder="Search Here..." aria-label="Search Here" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text bg-success" id="basic-addon2"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <hr>
                </div>
                <!-- Author By: MH RONY
Author Website: https://developerrony.com
Github Link: https://github.com/dev-mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
-->

                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-3" id="cab_list">
                    <?php 
                    $cabs = $conn->query("SELECT c.*, cc.name as category FROM `cab_list` c inner join category_list cc on c.category_id = cc.id where c.delete_flag = 0 and c.id not in (SELECT cab_id FROM `booking_list` where `status` in (0,1,2)) order by c.`reg_code`");
                    while($row= $cabs->fetch_assoc()):
                    ?>
                    <a class="col item text-decoration-none text-dark book_cab" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-bodyno="<?php echo $row['body_no'] ?>">
                        <div class="callout callout-primary border-success rounded-0">
                            <dl>
                                <dt class="h3"><i class="fa fa-taxi"></i> <?php echo $row['body_no'] ?></dt>
                                <dd class="truncate-3 text-muted lh-1">
                                    <small><?php echo $row['category'] ?></small><br>
                                    <small><?php echo $row['cab_model'] ?></small>
                                </dd>
                            </dl>
                        </div>
                    </a>
                    <?php endwhile; ?>
                </div>
                <!-- Author By: MH RONY
Author Website: https://developerrony.com
Github Link: https://github.com/dev-mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
-->

                <div id="noResult" style="display:none" class="text-center"><b>No Results!!</b></div>
            </div>
        </div>
    </div>
</section>
<!-- Author By: MH RONY
Author Website: https://developerrony.com
Github Link: https://github.com/dev-mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
-->

<script>
$(function() {
    $('#search').on('input', function() {
        var _search = $(this).val().toLowerCase().trim()
        $('#cab_list .item').each(function() {
            var _text = $(this).text().toLowerCase().trim()
            _text = _text.replace(/\s+/g, ' ')
            console.log(_text)
            if ((_text).includes(_search) == true) {
                $(this).toggle(true)
            } else {
                $(this).toggle(false)
            }
        })
        if ($('#cab_list .item:visible').length > 0) {
            $('#noResult').hide('slow')
        } else {
            $('#noResult').show('slow')
        }
    })
    $('#cab_list .item').hover(function() {
        $(this).find('.callout').addClass('shadow')
    })
    $('#cab_list .book_cab').click(function() {
        if ("<?= $_settings->userdata('id') && $_settings->userdata('login_type') == 2 ?>" == 1)
            uni_modal("Book Cab - " + $(this).attr('data-bodyno'), "booking.php?cid=" + $(this).attr('data-id'), 'mid-large');
        else
            location.href = './login.php';
    })
    $('#send_request').click(function() {
        if ("<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2 ?>" == 1)
            uni_modal("Fill the cab Request Form", "send_request.php", 'mid-large');
        else
            alert_toast(" Please Login First.", "warning");
    })

})
$(document).scroll(function() {
    $('#topNavBar').removeClass('bg-purple navbar-light navbar-dark bg-gradient-purple text-light')
    if ($(window).scrollTop() === 0) {
        $('#topNavBar').addClass('navbar-dark bg-purple text-light')
    } else {
        $('#topNavBar').addClass('navbar-dark bg-gradient-purple ')
    }
});
$(function() {
    $(document).trigger('scroll')
})
</script>
<!-- Author By: MH RONY
Author Website: https://developerrony.com
Github Link: https://github.com/dev-mhrony
Youtube Link: https://www.youtube.com/channel/UChYhUxkwDNialcxj-OFRcDw
-->