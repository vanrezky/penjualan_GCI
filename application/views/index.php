            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= $title; ?></h1>
                    </div>
                    <div class="section-body">
                        <?php if ($this->session->userdata('role_id') == 2) { ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Chart Penjualan Harian</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="myBarChart" width="668" height="320" class="chartjs-render-monitor" style="display: block; width: 668px; height: 320px;"></canvas>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </section>
            </div>