@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-xl-5 box-col-12 des-xl-100">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-md-6 box-col-6 des-xl-50">
                        <div class="card profile-greeting">
                            <div class="card-header">
                                <div class="header-top">
                                    <div class="setting-list bg-primary position-unset">
                                        <ul class="list-unstyled setting-option">
                                            <li>
                                                <div class="setting-white"><i class="icon-settings"></i></div>
                                            </li>
                                            <li><i class="view-html fa fa-code font-white"></i></li>
                                            <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card font-white"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card font-white"></i></li>
                                            <li><i class="icofont icofont-error close-card font-white"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center p-t-0">
                                <h3 class="font-light">Welcome Back, {{ Auth::user()->first_name }}!!</h3>
                                <p>Welcome to the {{ config('app.name', 'SAFIRI') }} Family! we are glad to see you today. We will be
                                    happy to help you grow your business.</p>
                                <button class="btn btn-light">Update</button>
                            </div>
                            <div class="confetti">
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="confetti-piece"></div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard"
                                            data-clipboard-target="#profile-greeting"
                                            title="Copy"><i
                                            class="icofont icofont-copy-alt"></i></button>
                                    <pre><code class="language-html" id="profile-greeting"></code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-6 box-col-6 des-xl-50 rate-sec">
                        <div class="card income-card card-secondary">
                            <div class="card-body text-center">
                                <div class="round-box">
                                    <i class="fas fa-money-bill-alt" style="color: #ba895d"></i>
                                </div>
                                <h5>KSH.{{ number_format($annualIncome, 2) }}</h5>
                                <p>our Annual income</p><a class="btn-arrow arrow-secondary" href="javascript:void(0)">
                                    <i class="toprightarrow-secondary fa fa-arrow-up me-2"></i>90.54% </a>
                                <div class="parrten">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewbox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path
                                    d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M96,100.16                                            c50.315,35.939,80.124,94.008,80,155.84c0.151,61.839-29.664,119.919-80,155.84C11.45,325.148,11.45,186.851,96,100.16z M256,480                                            c-49.143,0.007-96.907-16.252-135.84-46.24C175.636,391.51,208.14,325.732,208,256c0.077-69.709-32.489-135.434-88-177.6                                            c80.1-61.905,191.9-61.905,272,0c-98.174,75.276-116.737,215.885-41.461,314.059c11.944,15.577,25.884,29.517,41.461,41.461                                            C353.003,463.884,305.179,480.088,256,480z M416,412v-0.16c-86.068-61.18-106.244-180.548-45.064-266.616                                            c12.395-17.437,27.627-32.669,45.064-45.064C500.654,186.871,500.654,325.289,416,412z"></path>
                            </g>
                        </g>
                      </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 box-col-12 des-xl-100 dashboard-sec">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Revenue</h5>
                        <div class="chart-config select d-flex align-items-center"></div>
                    </div>
                    <div class="card-body">
                        <div data-chart-name="revenue" id="revenue-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 box-col-12 des-xl-100">
                <div class="row">
                    <div class="col-xl-12 recent-order-sec">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h5>Recent Bookings</h5>
                                    <table class="table table-bordernone">
                                        <thead>
                                        <tr>
                                            <th>Destination</th>
                                            <th>Guests</th>
                                            <th>Dates</th>
                                            <th>Total</th>
                                            <th>
                                                <div class="setting-list">
                                                    <ul class="list-unstyled setting-option">
                                                        <li>
                                                            <div class="setting-primary"><i class="icon-settings"> </i>
                                                            </div>
                                                        </li>
                                                        <li><i class="view-html fa fa-code font-primary"></i></li>
                                                        <li>
                                                            <i class="icofont icofont-maximize full-card font-primary"></i>
                                                        </li>
                                                        <li>
                                                            <i class="icofont icofont-minus minimize-card font-primary"></i>
                                                        </li>
                                                        <li>
                                                            <i class="icofont icofont-refresh reload-card font-primary"></i>
                                                        </li>
                                                        <li>
                                                            <i class="icofont icofont-error close-card font-primary"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($recentBookings as $booking)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <img class="img-fluid rounded-circle"
                                                             src="{{ asset("images/destinations/{$booking->destination->image}") }}"
                                                             alt="" data-original-title="" title="">
                                                        <div class="media-body">
                                                            <a href="#"><span>{{ $booking->destination->name }}</span></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>{{ $booking->guests }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $booking->dates }}</p>
                                                </td>
                                                <td>{{ number_format($booking->total) }}/=</td>
                                                <td>
                                                    <p>{{ $booking->is_paid ? "Paid" : "Pending" }}</p>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard"
                                            data-clipboard-target="#recent-order" title="Copy">
                                        <i class="icofont icofont-copy-alt"></i>
                                    </button>
                                    <pre><code class="language-html" id="recent-bookings"></code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @once
        @push('scripts')
            <!-- Plugins JS start-->
            <script src="{{ asset('vendor/viho/js/dashboard/default.js') }}"></script>
            <!-- Charting library -->
            <script src="{{ asset('vendor/chartisan/chart.min.js') }}"></script>
            <script src="{{ asset('vendor/chartisan/chartisan.umd.js') }}"></script>
            <script src="{{ asset('js/admin/chartisan.js') }}"></script>
            <!-- Plugins JS Ends-->
            <script>
                const chart = {
                    revenue: new Chartisan({
                        el: '#revenue-chart',
                        url: "@chart('revenue')",
                        loader: LOADER,
                        hooks: globalHooks()
                            .beginAtZero()
                            .title('Revenue earned.')
                            .colors(['rgb(30, 100, 225)'])
                            .tooltip({
                                callbacks: {
                                    label: function (tooltipItem, data) {
                                        let dataset = data.datasets[tooltipItem.datasetIndex];
                                        let currentValue = dataset.data[tooltipItem.index];

                                        return new Intl.NumberFormat('en-GB', {style: 'currency', currency: 'KES'}).format(currentValue)
                                    }
                                }
                            })
                            .datasets([
                                {
                                    type: 'line', fill: true,
                                    backgroundColor: gradientColor([50, 155, 255]),
                                    borderColor: `rgb(30, 100, 225)`,
                                }
                            ])
                    }),
                }
            </script>
        @endpush
    @endonce
@endsection
