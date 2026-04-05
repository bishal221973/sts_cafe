<style>
    .report-nav {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .report-btn {
        position: relative;
        padding: 8px 16px;
        border-radius: 8px;
        background: #f8f9fa;
        color: #333;
        text-decoration: none;
        transition: all 0.25s ease;
        font-weight: 500;
    }

    /* Hover effect */
    .report-btn:hover {
        background: #e3f2fd;
        color: #0d6efd;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Active button */
    .report-btn.active {
        background: #0dcaf0;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Animated underline */
    .report-btn::after {
        content: "";
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0%;
        height: 2px;
        background: #0d6efd;
        transition: width 0.3s ease;
    }
    .report-btn.active::after{
         content: "";
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0%;
        height: 0px;
        background: #0d6efd;
        transition: width 0.3s ease;
    }

    .report-btn:hover::after {
        width: 100%;
    }

    .report-btn.active::after {
        width: 100%;
        background: #fff;
    }
</style>

<div class="report-nav">

    <a href="{{route('report.normal')}}"
       class="report-btn {{ request()->routeIs('report.normal') ? 'active' : '' }}">
        Daily Report
    </a>

    <a href="{{route('report.monthly')}}"
       class="report-btn {{ request()->routeIs('report.monthly') ? 'active' : '' }}">
        Monthly Report
    </a>

    <a href="{{route('report.productWise')}}"
       class="report-btn {{ request()->routeIs('report.productWise') ? 'active' : '' }}">
        Product Wise
    </a>

    <a href="{{route('report.userWise')}}"
       class="report-btn {{ request()->routeIs('report.userWise') ? 'active' : '' }}">
        User Wise
    </a>

    <a href="{{route('report.cancelReport')}}"
       class="report-btn {{ request()->routeIs('report.cancelReport') ? 'active' : '' }}">
        Cancel Report
    </a>

</div>