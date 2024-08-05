@extends('layouts.app')

@section('content')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="desktop" role="img"
                                class="md hydrated" aria-label="home outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">Settings</button>
                <button type="button"
                    class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                        href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card radius-10">
                <div class="card-body" style="position: relative;">
                  <div class="d-flex align-items-start justify-content-between">
                    <div>
                      <p class="mb-2">Affiliate Campaign</p>
                      <h4 class="mb-0">1,090 <span class="ms-1 font-13">+36%</span></h4>
                    </div>

                  </div>
                  <div class="mt-3" id="chart1" style="min-height: 70px;">
                    <div id="apexchartscn5ecr0k" class="apexcharts-canvas apexchartscn5ecr0k apexcharts-theme-light" style="width: 268px; height: 70px;">
                        <svg id="SvgjsSvg1568" width="268" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1"
                             xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                             xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1570"
                           class="apexcharts-inner apexcharts-graphical"
                        transform="translate(0, 0)"><defs id="SvgjsDefs1569"><clipPath id="gridRectMaskcn5ecr0k"><rect id="SvgjsRect1575"
                       width="272" height="70" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none"
                       stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskcn5ecr0k"><rect
                    id="SvgjsRect1576" width="272" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                    fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1582" x1="0" y1="0" x2="0" y2="1">
                    <stop id="SvgjsStop1583" stop-opacity="1" stop-color="rgba(255,0,128,1)" offset="0"></stop><stop id="SvgjsStop1584" stop-opacity="1" stop-color="rgba(121,40,202,1)" offset="1"></stop>
                    <stop id="SvgjsStop1585" stop-opacity="1" stop-color="rgba(121,40,202,1)" offset="1"></stop></linearGradient></defs>
                    <line id="SvgjsLine1574" x1="0" y1="0" x2="0" y2="70" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="70" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1588" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1589" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1591" class="apexcharts-grid"><g id="SvgjsG1592" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1594" x1="0" y1="0" x2="268" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1595" x1="0" y1="17.5" x2="268" y2="17.5" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1596" x1="0" y1="35" x2="268" y2="35" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1597" x1="0" y1="52.5" x2="268" y2="52.5" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1598" x1="0" y1="70" x2="268" y2="70" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1593" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1600" x1="0" y1="70" x2="268" y2="70" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1599" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1578" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1579" class="apexcharts-series" seriesName="TotalxEarnings" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1586" d="M 0 70L 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70C 268 70 268 70 268 70M 268 70z" fill="url(#SvgjsLinearGradient1582)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskcn5ecr0k)" pathTo="M 0 70L 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70C 268 70 268 70 268 70M 268 70z" pathFrom="M -1 70L -1 70L 29.77777777777778 70L 59.55555555555556 70L 89.33333333333333 70L 119.11111111111111 70L 148.88888888888889 70L 178.66666666666666 70L 208.44444444444446 70L 238.22222222222223 70L 268 70"></path><path id="SvgjsPath1587" d="M 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70" fill="none" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskcn5ecr0k)" pathTo="M 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70" pathFrom="M -1 70L -1 70L 29.77777777777778 70L 59.55555555555556 70L 89.33333333333333 70L 119.11111111111111 70L 148.88888888888889 70L 178.66666666666666 70L 208.44444444444446 70L 238.22222222222223 70L 268 70"></path><g id="SvgjsG1580" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1606" r="0" cx="0" cy="0" class="apexcharts-marker w0j88osap no-pointer-events" stroke="#ffffff" fill="#923eb9" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1581" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1601" x1="0" y1="0" x2="268" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1602" x1="0" y1="0" x2="268" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1603" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1604" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1605" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1573" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1590" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1571" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 0, 128);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                <div class="resize-triggers"><div class="expand-trigger"><div style="width: 301px; height: 176px;"></div></div><div class="contract-trigger"></div></div></div>
            </div>
        </div>

        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card radius-10">
              <div class="card-body" style="position: relative;">
                <div class="d-flex align-items-start justify-content-between">
                  <div>
                    <p class="mb-2">Whatsapp Campaign</p>
                    <h4 class="mb-0">8,963 <span class="ms-1 font-13">+4.5%</span></h4>
                  </div>

                </div>
                <div class="mt-3" id="chart2" style="min-height: 70px;"><div id="apexchartsqmkbcfy8" class="apexcharts-canvas apexchartsqmkbcfy8 apexcharts-theme-light" style="width: 268px; height: 70px;">
                        <svg id="SvgjsSvg1608" width="268" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                             class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1610" class="apexcharts-inner apexcharts-graphical"
                                              transform="translate(0, 0)"><defs id="SvgjsDefs1609"><clipPath id="gridRectMaskqmkbcfy8"><rect id="SvgjsRect1615" width="272" height="70" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskqmkbcfy8"><rect id="SvgjsRect1616" width="272" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1622" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1623" stop-opacity="1" stop-color="rgba(255,106,0,1)" offset="0"></stop><stop id="SvgjsStop1624" stop-opacity="1" stop-color="rgba(238,9,121,1)" offset="1"></stop><stop id="SvgjsStop1625" stop-opacity="1" stop-color="rgba(238,9,121,1)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1614" x1="0" y1="0" x2="0" y2="70" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="70" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1628" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1629" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1631" class="apexcharts-grid"><g id="SvgjsG1632" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1634" x1="0" y1="0" x2="268" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1635" x1="0" y1="17.5" x2="268" y2="17.5" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1636" x1="0" y1="35" x2="268" y2="35" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1637" x1="0" y1="52.5" x2="268" y2="52.5" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1638" x1="0" y1="70" x2="268" y2="70" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1633" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1640" x1="0" y1="70" x2="268" y2="70" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1639" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1618" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1619" class="apexcharts-series" seriesName="TotalxExpense" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1626" d="M 0 70L 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70C 268 70 268 70 268 70M 268 70z" fill="url(#SvgjsLinearGradient1622)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqmkbcfy8)" pathTo="M 0 70L 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70C 268 70 268 70 268 70M 268 70z" pathFrom="M -1 70L -1 70L 29.77777777777778 70L 59.55555555555556 70L 89.33333333333333 70L 119.11111111111111 70L 148.88888888888889 70L 178.66666666666666 70L 208.44444444444446 70L 238.22222222222223 70L 268 70"></path><path id="SvgjsPath1627" d="M 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70" fill="none" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskqmkbcfy8)" pathTo="M 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70" pathFrom="M -1 70L -1 70L 29.77777777777778 70L 59.55555555555556 70L 89.33333333333333 70L 119.11111111111111 70L 148.88888888888889 70L 178.66666666666666 70L 208.44444444444446 70L 238.22222222222223 70L 268 70"></path><g id="SvgjsG1620" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1646" r="0" cx="0" cy="0" class="apexcharts-marker wya39djda no-pointer-events" stroke="#ffffff" fill="#ee0979" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1621" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1641" x1="0" y1="0" x2="268" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1642" x1="0" y1="0" x2="268" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1643" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1644" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1645" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1613" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1630" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1611" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 106, 0);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
              <div class="resize-triggers"><div class="expand-trigger"><div style="width: 301px; height: 176px;"></div></div><div class="contract-trigger"></div></div></div>
            </div>
          </div>

          <div class="col-12 col-lg-4 col-xl-4">
            <div class="card radius-10">
              <div class="card-body" style="position: relative;">
                <div class="d-flex align-items-start justify-content-between">
                  <div>
                    <p class="mb-2">SMS Campaign</p>
                    <h4 class="mb-0">86,279 <span class="ms-1 font-13">+5.6%</span></h4>
                  </div>

                </div>
                <div class="mt-3" id="chart3" style="min-height: 70px;"><div id="apexchartst8pz0wq1" class="apexcharts-canvas apexchartst8pz0wq1 apexcharts-theme-light" style="width: 268px; height: 70px;">
                  <svg id="SvgjsSvg1648" width="268" height="70" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1650" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1649"><clipPath id="gridRectMaskt8pz0wq1"><rect id="SvgjsRect1655" width="272" height="70" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskt8pz0wq1"><rect id="SvgjsRect1656" width="272" height="74" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1662" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1663" stop-opacity="1" stop-color="rgba(42,245,152,1)" offset="0"></stop><stop id="SvgjsStop1664" stop-opacity="1" stop-color="rgba(0,158,253,1)" offset="1"></stop><stop id="SvgjsStop1665" stop-opacity="1" stop-color="rgba(0,158,253,1)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1654" x1="267.5" y1="0" x2="267.5" y2="70" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="267.5" y="0" width="1" height="70" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1668" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1669" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1671" class="apexcharts-grid"><g id="SvgjsG1672" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1674" x1="0" y1="0" x2="268" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1675" x1="0" y1="17.5" x2="268" y2="17.5" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1676" x1="0" y1="35" x2="268" y2="35" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1677" x1="0" y1="52.5" x2="268" y2="52.5" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1678" x1="0" y1="70" x2="268" y2="70" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1673" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1680" x1="0" y1="70" x2="268" y2="70" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1679" x1="0" y1="1" x2="0" y2="70" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1658" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1659" class="apexcharts-series" seriesName="TotalxOrders" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1666" d="M 0 70L 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70C 268 70 268 70 268 70M 268 70z" fill="url(#SvgjsLinearGradient1662)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskt8pz0wq1)" pathTo="M 0 70L 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70C 268 70 268 70 268 70M 268 70z" pathFrom="M -1 70L -1 70L 29.77777777777778 70L 59.55555555555556 70L 89.33333333333333 70L 119.11111111111111 70L 148.88888888888889 70L 178.66666666666666 70L 208.44444444444446 70L 238.22222222222223 70L 268 70"></path><path id="SvgjsPath1667" d="M 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70" fill="none" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskt8pz0wq1)" pathTo="M 0 70C 10.422222222222222 70 19.355555555555554 56 29.77777777777778 56C 40.2 56 49.13333333333333 11.287500000000001 59.55555555555556 11.287500000000001C 69.97777777777777 11.287500000000001 78.91111111111111 33.775 89.33333333333333 33.775C 99.75555555555556 33.775 108.6888888888889 21.4375 119.11111111111111 21.4375C 129.53333333333333 21.4375 138.46666666666667 33.775 148.88888888888889 33.775C 159.3111111111111 33.775 168.24444444444444 21.4375 178.66666666666666 21.4375C 189.08888888888887 21.4375 198.02222222222224 47.5125 208.44444444444446 47.5125C 218.86666666666667 47.5125 227.8 43.75 238.22222222222223 43.75C 248.64444444444445 43.75 257.5777777777778 70 268 70" pathFrom="M -1 70L -1 70L 29.77777777777778 70L 59.55555555555556 70L 89.33333333333333 70L 119.11111111111111 70L 148.88888888888889 70L 178.66666666666666 70L 208.44444444444446 70L 238.22222222222223 70L 268 70"></path><g id="SvgjsG1660" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1686" r="0" cx="268" cy="0" class="apexcharts-marker wamiiqz02 no-pointer-events" stroke="#ffffff" fill="#009efd" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1661" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1681" x1="0" y1="0" x2="268" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1682" x1="0" y1="0" x2="268" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1683" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1684" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1685" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1653" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1670" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1651" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip apexcharts-theme-dark" style="left: 225.82px; top: 37px;"><div class="apexcharts-tooltip-series-group apexcharts-active" style="display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(42, 245, 152); display: none;"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value">0</span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
              <div class="resize-triggers"><div class="expand-trigger"><div style="width: 301px; height: 176px;"></div></div><div class="contract-trigger"></div></div></div>
            </div>
          </div>
    </div>


    <div class="row">
        <div class="col-12 col-lg-8 col-xl-8 d-flex">
          <div class="card radius-10 w-100">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <h6 class="mb-0">Audiences Metrics</h6>
                <div class="dropdown options ms-auto">
                  <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon>
                  </div>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                  </ul>
                </div>
              </div>
              <div class="row row-cols-1 row-cols-lg-3 g-3 justify-content-start align-items-center mb-3">
                <div class="col">
                  <h5 class="mb-0">974 <span class="text-success font-13">56% <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon></span></h5>
                  <p class="mb-0">Avg. Session</p>
                </div>
                <div class="col">
                  <h5 class="mb-0">1,218 <span class="text-success font-13">34% <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon></span></h5>
                  <p class="mb-0">Conversion. Rate</p>
                </div>
                <div class="col">
                  <h5 class="mb-0">10,317 <span class="text-success font-13">22% <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon></span></h5>
                  <p class="mb-0">Avg. Session Duration</p>
                </div>
              </div><!--end row-->

              <div class="chart-container7">
                <canvas id="chart4" style="display: block; box-sizing: border-box; height: 300px; width: 592.5px;" width="1185" height="600"></canvas>
              </div>

            </div>
          </div>
        </div>

        <div class="col-12 col-lg-4 col-xl-4 d-flex">
          <div class="card radius-10 overflow-hidden w-100">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <h6 class="mb-0">Campaign Actions</h6>
                <div class="dropdown options ms-auto">
                  <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon>
                  </div>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                  </ul>
                </div>
              </div>
              <div class="chart-container6">
                <div class="piechart-legend">
                  <h2 class="mb-1">8,452</h2>
                  <h6 class="mb-0">Total Sessions</h6>
                 </div>
                <canvas id="chart5" style="display: block; box-sizing: border-box; height: 250px; width: 268px;" width="536" height="500"></canvas>
              </div>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                Shared
                <span class="badge bg-tiffany rounded-pill">558</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Read
                <span class="badge bg-success rounded-pill">204</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Likes
                <span class="badge bg-danger rounded-pill">108</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="row row-cols-1 row-cols-xl-3">
          <div class="col d-flex">
            <div class="card radius-10 w-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h6 class="mb-0">Constituency Ranking</h6>
                  <div class="dropdown options ms-auto">
                    <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                      <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon>
                    </div>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
                <div class="chart-container4">
                  <canvas id="chart6" style="display: block; box-sizing: border-box; height: 350px; width: 917px;" width="1834" height="700"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col d-flex">
            <div class="card radius-10 w-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h6 class="mb-0">Daily Engagements</h6>
                  <div class="dropdown options ms-auto">
                    <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                      <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon>
                    </div>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
                <div class="chart-container4">
                  <canvas id="chart7" style="display: block; box-sizing: border-box; height: 350px; width: 917px;" width="1834" height="700"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col d-flex">
            <div class="card radius-10 overflow-hidden w-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h6 class="mb-0">Shared Posts & Points</h6>
                  <div class="dropdown options ms-auto">
                    <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                      <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon>
                    </div>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
                <div class="chart-container4">
                  <canvas id="chart8" style="display: block; box-sizing: border-box; height: 350px; width: 917px;" width="1834" height="700"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>


    

    
    </div><!--end row-->




    @endsection
