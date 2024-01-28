@push('css')
    <style>

        .balance {
            color: #28a745; /* positive income color */
        }

        /* Financial Cards Styling */
        .financial-cards {
        }
        .projection {
            font-size: 0.9rem;
            color: #6c757d; /* gray */
            margin-top: 10px;
        }
        @media (max-width: 768px) {
            .financial-cards .card {
                /*padding: 10px;*/
            }
        }


        /* Financial Metrics Styling */
        .financial-metrics {
            display: flex;
            flex-wrap: wrap; /* Allows flex items to wrap onto multiple lines */
            justify-content: space-between;
            margin-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        .metric-item {
            flex: 0 0 50%; /* Don't grow, don't shrink, start at 50% of the container's width */
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
            padding: 10px; /* Just for some spacing */
            text-align: center;
        }
        .metric-item .label {
            font-size: 0.8rem;
            color: #6c757d; /* gray */
        }
        .metric-item .value {
            font-size: 1.2rem;
            font-weight: bold;
        }

        /* Responsiveness for Financial Metrics */
        @media (max-width: 768px) {
            .financial-metrics {
            }
            .metric-item {
            }
            .metric-item:last-child {
            }
        }


        /* Financial Summary Styling */
        .financial-summary {
            display: flex;
            flex-direction: column;
            background: #fff;
            padding: .5rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .summary-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 0;
        }
        .summary-item:last-child {
            border-bottom: none;
        }
        .time-frame {
            /*font-size: 1.2rem;*/
            font-weight: bold;
            color: #333;
            width: 20%;
        }
        .details {
            width: 80%;
            padding-left: 20px;
        }
        .income {
            /*font-size: 1.5rem;*/
            font-weight: bold;
            color: #28a745; /* positive income color */
        }
        .comparison {
            font-size: 0.8rem;
            margin-top: 5px;
        }
        .comparison .fa-arrow-up, .comparison .fa-arrow-down {
            margin-right: 5px;
        }
        .projection {
            font-size: 0.9rem;
            color: #6c757d; /* gray */
            margin-top: 10px;
        }
        @media (max-width: 768px) {
            .financial-summary {
                padding: 10px;
            }
            .details {
                padding-left: 10px;
            }
        }

    </style>
@endpush

@push('js')
@endpush

<div class="card">
    <h5 class="card-header">
        <i class="fas fa-money-bill mr-1"></i>
        Finance
        <div class="metric-item float-right balance">
            <div class="label">Balance</div>
            <div class="value">$1,200.00</div>
        </div>
    </h5>

    <div class="card-body">
        <div class="financial-summary">

            <!-- Financial Metrics -->
            <div class="financial-metrics">
                <div class="metric-item">
                    <div class="label">Paid</div>
                    <div class="value">$800.00</div>
                </div>
                <div class="metric-item">
                    <div class="label">Unpaid</div>
                    <div class="value">$400.00</div>
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="summary-item">
                <div class="time-frame">Daily</div>
                <div class="details text-right">
                    <div class="income">$256.00</div>
                    <div class="comparison positive">
                        <i class="fa-solid fa-arrow-up"></i> 5% from yesterday
                    </div>
                    <div class="projection">
                        Tomorrow's Projection: $260.00
                    </div>
                </div>
            </div>
            <div class="summary-item">
                <div class="time-frame">Weekly</div>
                <div class="details text-right">
                    <div class="income">$256.00</div>
                    <div class="comparison positive">
                        <i class="fa-solid fa-arrow-up"></i> 5% from yesterday
                    </div>
                    <div class="projection">
                        Tomorrow's Projection: $260.00
                    </div>
                </div>
            </div>
            <div class="summary-item">
                <div class="time-frame">Monthly</div>
                <div class="details text-right">
                    <div class="income">$256.00</div>
                    <div class="comparison positive">
                        <i class="fa-solid fa-arrow-up"></i> 5% from yesterday
                    </div>
                    <div class="projection">
                        Tomorrow's Projection: $260.00
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
