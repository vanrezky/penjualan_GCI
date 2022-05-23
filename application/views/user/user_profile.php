<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title;?></h1>
        </div>
        <div class="col-12 col-sm-12 col-lg-7">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-left">
                        <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                        <div class="clearfix"></div>
                    </div>
                    <div class="author-box-details">
                        <div class="author-box-name">
                            <a><?= $user['name']?></a>
                        </div>
                        <div class="author-box-job"><?= $user['role']?></div>
                        <div class="mb-2 mt-3">
                            <div class="text-small font-weight-bold">Bergabung sejak :  <?= date('d F Y' ,$user['date_created'])?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>