@extends('layouts.app')

@section('content')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Campaign With Us</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="image" role="img"
                                class="md hydrated" aria-label="home outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Affiliate Campaign</li>
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

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <div class="fs-5"><ion-icon name="share-outline" role="img" class="md hydrated"
                                aria-label="person add outline"></ion-icon></div>
                        <div>
                            <p class="mb-0">Shared posts</p>
                        </div>
                        <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp" role="img"
                                class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon></div>
                    </div>
                    <div class="d-flex align-items-center mt-3" style="position: relative;">
                        <div>
                            <h5 class="mb-0">11,037</h5>
                        </div>
                        <div class="ms-auto" id="chart4" style="min-height: 40px;">
                            <div id="apexchartshtyq9rpb" class="apexcharts-canvas apexchartshtyq9rpb apexcharts-theme-light"
                                style="width: 150px; height: 40px;"><svg id="SvgjsSvg2135" width="150" height="40"
                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                    class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                    style="background: transparent;">
                                    <g id="SvgjsG2137" class="apexcharts-inner apexcharts-graphical"
                                        transform="translate(0, 0)">
                                        <defs id="SvgjsDefs2136">
                                            <clipPath id="gridRectMaskhtyq9rpb">
                                                <rect id="SvgjsRect2142" width="156" height="42" x="-3" y="-1"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskhtyq9rpb">
                                                <rect id="SvgjsRect2143" width="154" height="44" x="-2" y="-2"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <linearGradient id="SvgjsLinearGradient2149" x1="0" y1="0"
                                                x2="0" y2="1">
                                                <stop id="SvgjsStop2150" stop-opacity="0.5"
                                                    stop-color="rgba(247,151,30,0.5)" offset="0"></stop>
                                                <stop id="SvgjsStop2151" stop-opacity="0.1"
                                                    stop-color="rgba(255,210,0,0.1)" offset="1"></stop>
                                                <stop id="SvgjsStop2152" stop-opacity="0.1"
                                                    stop-color="rgba(255,210,0,0.1)" offset="1"></stop>
                                            </linearGradient>
                                        </defs>
                                        <line id="SvgjsLine2141" x1="0" y1="0" x2="0"
                                            y2="40" stroke="#b6b6b6" stroke-dasharray="3"
                                            class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="40"
                                            fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                        <g id="SvgjsG2155" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG2156" class="apexcharts-xaxis-texts-g"
                                                transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG2158" class="apexcharts-grid">
                                            <g id="SvgjsG2159" class="apexcharts-gridlines-horizontal"
                                                style="display: none;">
                                                <line id="SvgjsLine2161" x1="0" y1="0" x2="150"
                                                    y2="0" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2162" x1="0" y1="10" x2="150"
                                                    y2="10" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2163" x1="0" y1="20" x2="150"
                                                    y2="20" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2164" x1="0" y1="30" x2="150"
                                                    y2="30" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2165" x1="0" y1="40" x2="150"
                                                    y2="40" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG2160" class="apexcharts-gridlines-vertical"
                                                style="display: none;"></g>
                                            <line id="SvgjsLine2167" x1="0" y1="40" x2="150"
                                                y2="40" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine2166" x1="0" y1="1" x2="0"
                                                y2="40" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG2145" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG2146" class="apexcharts-series" seriesName="TotalxOrders"
                                                data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath2153"
                                                    d="M 0 40L 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40C 150 40 150 40 150 40M 150 40z"
                                                    fill="url(#SvgjsLinearGradient2149)" fill-opacity="1"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                    stroke-dasharray="0" class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMaskhtyq9rpb)"
                                                    pathTo="M 0 40L 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40C 150 40 150 40 150 40M 150 40z"
                                                    pathFrom="M -1 40L -1 40L 30 40L 60 40L 90 40L 120 40L 150 40"></path>
                                                <path id="SvgjsPath2154"
                                                    d="M 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40"
                                                    fill="none" fill-opacity="1" stroke="#f7971e" stroke-opacity="1"
                                                    stroke-linecap="butt" stroke-width="2" stroke-dasharray="0"
                                                    class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMaskhtyq9rpb)"
                                                    pathTo="M 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40"
                                                    pathFrom="M -1 40L -1 40L 30 40L 60 40L 90 40L 120 40L 150 40"></path>
                                                <g id="SvgjsG2147" class="apexcharts-series-markers-wrap"
                                                    data:realIndex="0">
                                                    <g class="apexcharts-series-markers">
                                                        <circle id="SvgjsCircle2173" r="0" cx="0" cy="0"
                                                            class="apexcharts-marker wexzs2579 no-pointer-events"
                                                            stroke="#ffffff" fill="#f7971e" fill-opacity="1"
                                                            stroke-width="2" stroke-opacity="0.9"
                                                            default-marker-size="0"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG2148" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine2168" x1="0" y1="0" x2="150"
                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                            class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine2169" x1="0" y1="0" x2="150"
                                            y2="0" stroke-dasharray="0" stroke-width="0"
                                            class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG2170" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG2171" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG2172" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <rect id="SvgjsRect2140" width="0" height="0" x="0" y="0" rx="0"
                                        ry="0" opacity="1" stroke-width="0" stroke="none"
                                        stroke-dasharray="0" fill="#fefefe"></rect>
                                    <g id="SvgjsG2157" class="apexcharts-yaxis" rel="0"
                                        transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG2138" class="apexcharts-annotations"></g>
                                </svg>
                                <div class="apexcharts-legend"></div>
                                <div class="apexcharts-tooltip apexcharts-theme-dark">
                                    <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker"
                                            style="background-color: rgb(247, 151, 30);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-label"></span><span
                                                    class="apexcharts-tooltip-text-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="resize-triggers">
                            <div class="expand-trigger">
                                <div style="width: 432px; height: 41px;"></div>
                            </div>
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <div class="fs-5"><ion-icon name="heart-outline" role="img" class="md hydrated"
                                aria-label="heart outline"></ion-icon></div>
                        <div>
                            <p class="mb-0">Likes</p>
                        </div>
                        <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp" role="img"
                                class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon></div>
                    </div>
                    <div class="d-flex align-items-center mt-3" style="position: relative;">
                        <div>
                            <h5 class="mb-0">23,758</h5>
                        </div>
                        <div class="ms-auto" id="chart5" style="min-height: 40px;">
                            <div id="apexcharts8feu09a1j"
                                class="apexcharts-canvas apexcharts8feu09a1j apexcharts-theme-light"
                                style="width: 150px; height: 40px;"><svg id="SvgjsSvg2175" width="150" height="40"
                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                    class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                    style="background: transparent;">
                                    <g id="SvgjsG2177" class="apexcharts-inner apexcharts-graphical"
                                        transform="translate(0, 0)">
                                        <defs id="SvgjsDefs2176">
                                            <clipPath id="gridRectMask8feu09a1j">
                                                <rect id="SvgjsRect2182" width="156" height="42" x="-3" y="-1"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMask8feu09a1j">
                                                <rect id="SvgjsRect2183" width="154" height="44" x="-2" y="-2"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <linearGradient id="SvgjsLinearGradient2189" x1="0" y1="0"
                                                x2="0" y2="1">
                                                <stop id="SvgjsStop2190" stop-opacity="0.5"
                                                    stop-color="rgba(23,173,55,0.5)" offset="0"></stop>
                                                <stop id="SvgjsStop2191" stop-opacity="0.1"
                                                    stop-color="rgba(152,236,45,0.1)" offset="1"></stop>
                                                <stop id="SvgjsStop2192" stop-opacity="0.1"
                                                    stop-color="rgba(152,236,45,0.1)" offset="1"></stop>
                                            </linearGradient>
                                        </defs>
                                        <line id="SvgjsLine2181" x1="0" y1="0" x2="0"
                                            y2="40" stroke="#b6b6b6" stroke-dasharray="3"
                                            class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="40"
                                            fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                        <g id="SvgjsG2195" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG2196" class="apexcharts-xaxis-texts-g"
                                                transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG2198" class="apexcharts-grid">
                                            <g id="SvgjsG2199" class="apexcharts-gridlines-horizontal"
                                                style="display: none;">
                                                <line id="SvgjsLine2201" x1="0" y1="0" x2="150"
                                                    y2="0" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2202" x1="0" y1="10" x2="150"
                                                    y2="10" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2203" x1="0" y1="20" x2="150"
                                                    y2="20" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2204" x1="0" y1="30" x2="150"
                                                    y2="30" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2205" x1="0" y1="40" x2="150"
                                                    y2="40" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG2200" class="apexcharts-gridlines-vertical"
                                                style="display: none;"></g>
                                            <line id="SvgjsLine2207" x1="0" y1="40" x2="150"
                                                y2="40" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine2206" x1="0" y1="1" x2="0"
                                                y2="40" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG2185" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG2186" class="apexcharts-series" seriesName="TotalxOrders"
                                                data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath2193"
                                                    d="M 0 40L 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40C 150 40 150 40 150 40M 150 40z"
                                                    fill="url(#SvgjsLinearGradient2189)" fill-opacity="1"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                    stroke-dasharray="0" class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMask8feu09a1j)"
                                                    pathTo="M 0 40L 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40C 150 40 150 40 150 40M 150 40z"
                                                    pathFrom="M -1 40L -1 40L 30 40L 60 40L 90 40L 120 40L 150 40"></path>
                                                <path id="SvgjsPath2194"
                                                    d="M 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40"
                                                    fill="none" fill-opacity="1" stroke="#17ad37" stroke-opacity="1"
                                                    stroke-linecap="butt" stroke-width="2" stroke-dasharray="0"
                                                    class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMask8feu09a1j)"
                                                    pathTo="M 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40"
                                                    pathFrom="M -1 40L -1 40L 30 40L 60 40L 90 40L 120 40L 150 40"></path>
                                                <g id="SvgjsG2187" class="apexcharts-series-markers-wrap"
                                                    data:realIndex="0">
                                                    <g class="apexcharts-series-markers">
                                                        <circle id="SvgjsCircle2213" r="0" cx="0" cy="0"
                                                            class="apexcharts-marker w5d2oxch1 no-pointer-events"
                                                            stroke="#ffffff" fill="#17ad37" fill-opacity="1"
                                                            stroke-width="2" stroke-opacity="0.9"
                                                            default-marker-size="0"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG2188" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine2208" x1="0" y1="0" x2="150"
                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                            class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine2209" x1="0" y1="0" x2="150"
                                            y2="0" stroke-dasharray="0" stroke-width="0"
                                            class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG2210" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG2211" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG2212" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <rect id="SvgjsRect2180" width="0" height="0" x="0" y="0" rx="0"
                                        ry="0" opacity="1" stroke-width="0" stroke="none"
                                        stroke-dasharray="0" fill="#fefefe"></rect>
                                    <g id="SvgjsG2197" class="apexcharts-yaxis" rel="0"
                                        transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG2178" class="apexcharts-annotations"></g>
                                </svg>
                                <div class="apexcharts-legend"></div>
                                <div class="apexcharts-tooltip apexcharts-theme-dark">
                                    <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker"
                                            style="background-color: rgb(23, 173, 55);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-label"></span><span
                                                    class="apexcharts-tooltip-text-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="resize-triggers">
                            <div class="expand-trigger">
                                <div style="width: 432px; height: 41px;"></div>
                            </div>
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <div class="fs-5"><ion-icon name="chatbox-outline" role="img" class="md hydrated"
                                aria-label="chatbox outline"></ion-icon></div>
                        <div>
                            <p class="mb-0">Read posts</p>
                        </div>
                        <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp" role="img"
                                class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon></div>
                    </div>
                    <div class="d-flex align-items-center mt-3" style="position: relative;">
                        <div>
                            <h5 class="mb-0">1,139</h5>
                        </div>
                        <div class="ms-auto" id="chart6" style="min-height: 40px;">
                            <div id="apexchartsjpcio0e9k"
                                class="apexcharts-canvas apexchartsjpcio0e9k apexcharts-theme-light"
                                style="width: 150px; height: 40px;"><svg id="SvgjsSvg2215" width="150" height="40"
                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                    class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                    style="background: transparent;">
                                    <g id="SvgjsG2217" class="apexcharts-inner apexcharts-graphical"
                                        transform="translate(0, 0)">
                                        <defs id="SvgjsDefs2216">
                                            <clipPath id="gridRectMaskjpcio0e9k">
                                                <rect id="SvgjsRect2222" width="156" height="42" x="-3" y="-1"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMaskjpcio0e9k">
                                                <rect id="SvgjsRect2223" width="154" height="44" x="-2" y="-2"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <linearGradient id="SvgjsLinearGradient2229" x1="0" y1="0"
                                                x2="0" y2="1">
                                                <stop id="SvgjsStop2230" stop-opacity="0.5"
                                                    stop-color="rgba(0,91,234,0.5)" offset="0"></stop>
                                                <stop id="SvgjsStop2231" stop-opacity="0.1"
                                                    stop-color="rgba(0,198,251,0.1)" offset="1"></stop>
                                                <stop id="SvgjsStop2232" stop-opacity="0.1"
                                                    stop-color="rgba(0,198,251,0.1)" offset="1"></stop>
                                            </linearGradient>
                                        </defs>
                                        <line id="SvgjsLine2221" x1="0" y1="0" x2="0"
                                            y2="40" stroke="#b6b6b6" stroke-dasharray="3"
                                            class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="40"
                                            fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                        <g id="SvgjsG2235" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG2236" class="apexcharts-xaxis-texts-g"
                                                transform="translate(0, -4)"></g>
                                        </g>
                                        <g id="SvgjsG2238" class="apexcharts-grid">
                                            <g id="SvgjsG2239" class="apexcharts-gridlines-horizontal"
                                                style="display: none;">
                                                <line id="SvgjsLine2241" x1="0" y1="0" x2="150"
                                                    y2="0" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2242" x1="0" y1="10" x2="150"
                                                    y2="10" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2243" x1="0" y1="20" x2="150"
                                                    y2="20" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2244" x1="0" y1="30" x2="150"
                                                    y2="30" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2245" x1="0" y1="40" x2="150"
                                                    y2="40" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG2240" class="apexcharts-gridlines-vertical"
                                                style="display: none;"></g>
                                            <line id="SvgjsLine2247" x1="0" y1="40" x2="150"
                                                y2="40" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine2246" x1="0" y1="1" x2="0"
                                                y2="40" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG2225" class="apexcharts-area-series apexcharts-plot-series">
                                            <g id="SvgjsG2226" class="apexcharts-series" seriesName="TotalxOrders"
                                                data:longestSeries="true" rel="1" data:realIndex="0">
                                                <path id="SvgjsPath2233"
                                                    d="M 0 40L 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40C 150 40 150 40 150 40M 150 40z"
                                                    fill="url(#SvgjsLinearGradient2229)" fill-opacity="1"
                                                    stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                    stroke-dasharray="0" class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMaskjpcio0e9k)"
                                                    pathTo="M 0 40L 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40C 150 40 150 40 150 40M 150 40z"
                                                    pathFrom="M -1 40L -1 40L 30 40L 60 40L 90 40L 120 40L 150 40"></path>
                                                <path id="SvgjsPath2234"
                                                    d="M 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40"
                                                    fill="none" fill-opacity="1" stroke="#005bea" stroke-opacity="1"
                                                    stroke-linecap="butt" stroke-width="2" stroke-dasharray="0"
                                                    class="apexcharts-area" index="0"
                                                    clip-path="url(#gridRectMaskjpcio0e9k)"
                                                    pathTo="M 0 40C 10.5 40 19.5 32 30 32C 40.5 32 49.5 6.450000000000003 60 6.450000000000003C 70.5 6.450000000000003 79.5 19.3 90 19.3C 100.5 19.3 109.5 12.25 120 12.25C 130.5 12.25 139.5 40 150 40"
                                                    pathFrom="M -1 40L -1 40L 30 40L 60 40L 90 40L 120 40L 150 40"></path>
                                                <g id="SvgjsG2227" class="apexcharts-series-markers-wrap"
                                                    data:realIndex="0">
                                                    <g class="apexcharts-series-markers">
                                                        <circle id="SvgjsCircle2253" r="0" cx="0" cy="0"
                                                            class="apexcharts-marker wyjy2d8wdg no-pointer-events"
                                                            stroke="#ffffff" fill="#005bea" fill-opacity="1"
                                                            stroke-width="2" stroke-opacity="0.9"
                                                            default-marker-size="0"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG2228" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine2248" x1="0" y1="0" x2="150"
                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                            class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine2249" x1="0" y1="0" x2="150"
                                            y2="0" stroke-dasharray="0" stroke-width="0"
                                            class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG2250" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG2251" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG2252" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <rect id="SvgjsRect2220" width="0" height="0" x="0" y="0" rx="0"
                                        ry="0" opacity="1" stroke-width="0" stroke="none"
                                        stroke-dasharray="0" fill="#fefefe"></rect>
                                    <g id="SvgjsG2237" class="apexcharts-yaxis" rel="0"
                                        transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG2218" class="apexcharts-annotations"></g>
                                </svg>
                                <div class="apexcharts-legend"></div>
                                <div class="apexcharts-tooltip apexcharts-theme-dark">
                                    <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker"
                                            style="background-color: rgb(0, 91, 234);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-label"></span><span
                                                    class="apexcharts-tooltip-text-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="resize-triggers">
                            <div class="expand-trigger">
                                <div style="width: 432px; height: 41px;"></div>
                            </div>
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <div class="fs-5"><ion-icon name="tv-outline" role="img" class="md hydrated"
                                aria-label="mail outline"></ion-icon></div>
                        <div>
                            <p class="mb-0">Total campaign posts</p>
                        </div>
                        <div class="fs-5 ms-auto"><ion-icon name="ellipsis-horizontal-sharp" role="img"
                                class="md hydrated" aria-label="ellipsis horizontal sharp"></ion-icon></div>
                    </div>
                    <div class="d-flex align-items-center mt-3" style="position: relative;">
                        <div>
                            <h5 class="mb-0">1,037</h5>
                        </div>
                        <div class="ms-auto" id="chart7" style="min-height: 40px;">
                            <div id="apexcharts2aaxreno"
                                class="apexcharts-canvas apexcharts2aaxreno apexcharts-theme-light"
                                style="width: 150px; height: 40px;"><svg id="SvgjsSvg2254" width="150" height="40"
                                    xmlns="http://www.w3.org/2000/svg" version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                                    class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                    style="background: transparent;">
                                    <g id="SvgjsG2256" class="apexcharts-inner apexcharts-graphical"
                                        transform="translate(0, 0)">
                                        <defs id="SvgjsDefs2255">
                                            <linearGradient id="SvgjsLinearGradient2260" x1="0" y1="0"
                                                x2="0" y2="1">
                                                <stop id="SvgjsStop2261" stop-opacity="0.4"
                                                    stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                <stop id="SvgjsStop2262" stop-opacity="0.5"
                                                    stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                <stop id="SvgjsStop2263" stop-opacity="0.5"
                                                    stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                            </linearGradient>
                                            <clipPath id="gridRectMask2aaxreno">
                                                <rect id="SvgjsRect2265" width="154" height="40" x="-2" y="0"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMask2aaxreno">
                                                <rect id="SvgjsRect2266" width="154" height="44" x="-2" y="-2"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                        </defs>
                                        <rect id="SvgjsRect2264" width="6.5625" height="40" x="0" y="0"
                                            rx="0" ry="0" opacity="1" stroke-width="0"
                                            stroke-dasharray="3" fill="url(#SvgjsLinearGradient2260)"
                                            class="apexcharts-xcrosshairs" y2="40" filter="none"
                                            fill-opacity="0.9"></rect>
                                        <g id="SvgjsG2279" class="apexcharts-xaxis" transform="translate(0, 0)">
                                            <g id="SvgjsG2280" class="apexcharts-xaxis-texts-g"
                                                transform="translate(0, 2.75)"></g>
                                        </g>
                                        <g id="SvgjsG2282" class="apexcharts-grid">
                                            <g id="SvgjsG2283" class="apexcharts-gridlines-horizontal"
                                                style="display: none;">
                                                <line id="SvgjsLine2285" x1="0" y1="0" x2="150"
                                                    y2="0" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2286" x1="0" y1="10" x2="150"
                                                    y2="10" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2287" x1="0" y1="20" x2="150"
                                                    y2="20" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2288" x1="0" y1="30" x2="150"
                                                    y2="30" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                                <line id="SvgjsLine2289" x1="0" y1="40" x2="150"
                                                    y2="40" stroke="#e0e0e0" stroke-dasharray="0"
                                                    class="apexcharts-gridline"></line>
                                            </g>
                                            <g id="SvgjsG2284" class="apexcharts-gridlines-vertical"
                                                style="display: none;"></g>
                                            <line id="SvgjsLine2291" x1="0" y1="40" x2="150"
                                                y2="40" stroke="transparent" stroke-dasharray="0"></line>
                                            <line id="SvgjsLine2290" x1="0" y1="1" x2="0"
                                                y2="40" stroke="transparent" stroke-dasharray="0"></line>
                                        </g>
                                        <g id="SvgjsG2268" class="apexcharts-bar-series apexcharts-plot-series">
                                            <g id="SvgjsG2269" class="apexcharts-series" rel="1"
                                                seriesName="TotalxOrders" data:realIndex="0">
                                                <path id="SvgjsPath2271"
                                                    d="M 6.09375 40L 6.09375 32.640625Q 9.375 29.359375 12.65625 32.640625L 12.65625 32.640625L 12.65625 40L 12.65625 40z"
                                                    fill="rgba(121,40,202,0.85)" fill-opacity="1" stroke-opacity="1"
                                                    stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                    class="apexcharts-bar-area" index="0"
                                                    clip-path="url(#gridRectMask2aaxreno)"
                                                    pathTo="M 6.09375 40L 6.09375 32.640625Q 9.375 29.359375 12.65625 32.640625L 12.65625 32.640625L 12.65625 40L 12.65625 40z"
                                                    pathFrom="M 6.09375 40L 6.09375 40L 12.65625 40L 12.65625 40L 12.65625 40L 6.09375 40"
                                                    cy="31" cx="24.84375" j="0" val="180"
                                                    barHeight="9" barWidth="6.5625"></path>
                                                <path id="SvgjsPath2272"
                                                    d="M 24.84375 40L 24.84375 33.640625Q 28.125 30.359375 31.40625 33.640625L 31.40625 33.640625L 31.40625 40L 31.40625 40z"
                                                    fill="rgba(121,40,202,0.85)" fill-opacity="1" stroke-opacity="1"
                                                    stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                    class="apexcharts-bar-area" index="0"
                                                    clip-path="url(#gridRectMask2aaxreno)"
                                                    pathTo="M 24.84375 40L 24.84375 33.640625Q 28.125 30.359375 31.40625 33.640625L 31.40625 33.640625L 31.40625 40L 31.40625 40z"
                                                    pathFrom="M 24.84375 40L 24.84375 40L 31.40625 40L 31.40625 40L 31.40625 40L 24.84375 40"
                                                    cy="32" cx="43.59375" j="1" val="160"
                                                    barHeight="8" barWidth="6.5625"></path>
                                                <path id="SvgjsPath2273"
                                                    d="M 43.59375 40L 43.59375 8.090625000000003Q 46.875 4.809375000000003 50.15625 8.090625000000003L 50.15625 8.090625000000003L 50.15625 40L 50.15625 40z"
                                                    fill="rgba(121,40,202,0.85)" fill-opacity="1" stroke-opacity="1"
                                                    stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                    class="apexcharts-bar-area" index="0"
                                                    clip-path="url(#gridRectMask2aaxreno)"
                                                    pathTo="M 43.59375 40L 43.59375 8.090625000000003Q 46.875 4.809375000000003 50.15625 8.090625000000003L 50.15625 8.090625000000003L 50.15625 40L 50.15625 40z"
                                                    pathFrom="M 43.59375 40L 43.59375 40L 50.15625 40L 50.15625 40L 50.15625 40L 43.59375 40"
                                                    cy="6.450000000000003" cx="62.34375" j="2" val="671"
                                                    barHeight="33.55" barWidth="6.5625"></path>
                                                <path id="SvgjsPath2274"
                                                    d="M 62.34375 40L 62.34375 20.940625Q 65.625 17.659375 68.90625 20.940625L 68.90625 20.940625L 68.90625 40L 68.90625 40z"
                                                    fill="rgba(121,40,202,0.85)" fill-opacity="1" stroke-opacity="1"
                                                    stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                    class="apexcharts-bar-area" index="0"
                                                    clip-path="url(#gridRectMask2aaxreno)"
                                                    pathTo="M 62.34375 40L 62.34375 20.940625Q 65.625 17.659375 68.90625 20.940625L 68.90625 20.940625L 68.90625 40L 68.90625 40z"
                                                    pathFrom="M 62.34375 40L 62.34375 40L 68.90625 40L 68.90625 40L 68.90625 40L 62.34375 40"
                                                    cy="19.3" cx="81.09375" j="3" val="414"
                                                    barHeight="20.7" barWidth="6.5625"></path>
                                                <path id="SvgjsPath2275"
                                                    d="M 81.09375 40L 81.09375 13.890625Q 84.375 10.609375 87.65625 13.890625L 87.65625 13.890625L 87.65625 40L 87.65625 40z"
                                                    fill="rgba(121,40,202,0.85)" fill-opacity="1" stroke-opacity="1"
                                                    stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                    class="apexcharts-bar-area" index="0"
                                                    clip-path="url(#gridRectMask2aaxreno)"
                                                    pathTo="M 81.09375 40L 81.09375 13.890625Q 84.375 10.609375 87.65625 13.890625L 87.65625 13.890625L 87.65625 40L 87.65625 40z"
                                                    pathFrom="M 81.09375 40L 81.09375 40L 87.65625 40L 87.65625 40L 87.65625 40L 81.09375 40"
                                                    cy="12.25" cx="99.84375" j="4" val="555"
                                                    barHeight="27.75" barWidth="6.5625"></path>
                                                <path id="SvgjsPath2276"
                                                    d="M 99.84375 40L 99.84375 29.640625Q 103.125 26.359375 106.40625 29.640625L 106.40625 29.640625L 106.40625 40L 106.40625 40z"
                                                    fill="rgba(121,40,202,0.85)" fill-opacity="1" stroke-opacity="1"
                                                    stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                    class="apexcharts-bar-area" index="0"
                                                    clip-path="url(#gridRectMask2aaxreno)"
                                                    pathTo="M 99.84375 40L 99.84375 29.640625Q 103.125 26.359375 106.40625 29.640625L 106.40625 29.640625L 106.40625 40L 106.40625 40z"
                                                    pathFrom="M 99.84375 40L 99.84375 40L 106.40625 40L 106.40625 40L 106.40625 40L 99.84375 40"
                                                    cy="28" cx="118.59375" j="5" val="240"
                                                    barHeight="12" barWidth="6.5625"></path>
                                                <path id="SvgjsPath2277"
                                                    d="M 118.59375 40L 118.59375 24.140625Q 121.875 20.859375 125.15625 24.140625L 125.15625 24.140625L 125.15625 40L 125.15625 40z"
                                                    fill="rgba(121,40,202,0.85)" fill-opacity="1" stroke-opacity="1"
                                                    stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                    class="apexcharts-bar-area" index="0"
                                                    clip-path="url(#gridRectMask2aaxreno)"
                                                    pathTo="M 118.59375 40L 118.59375 24.140625Q 121.875 20.859375 125.15625 24.140625L 125.15625 24.140625L 125.15625 40L 125.15625 40z"
                                                    pathFrom="M 118.59375 40L 118.59375 40L 125.15625 40L 125.15625 40L 125.15625 40L 118.59375 40"
                                                    cy="22.5" cx="137.34375" j="6" val="350"
                                                    barHeight="17.5" barWidth="6.5625"></path>
                                                <path id="SvgjsPath2278"
                                                    d="M 137.34375 40L 137.34375 34.340625Q 140.625 31.059375000000003 143.90625 34.340625L 143.90625 34.340625L 143.90625 40L 143.90625 40z"
                                                    fill="rgba(121,40,202,0.85)" fill-opacity="1" stroke-opacity="1"
                                                    stroke-linecap="square" stroke-width="0" stroke-dasharray="0"
                                                    class="apexcharts-bar-area" index="0"
                                                    clip-path="url(#gridRectMask2aaxreno)"
                                                    pathTo="M 137.34375 40L 137.34375 34.340625Q 140.625 31.059375000000003 143.90625 34.340625L 143.90625 34.340625L 143.90625 40L 143.90625 40z"
                                                    pathFrom="M 137.34375 40L 137.34375 40L 143.90625 40L 143.90625 40L 143.90625 40L 137.34375 40"
                                                    cy="32.7" cx="156.09375" j="7" val="146"
                                                    barHeight="7.3" barWidth="6.5625"></path>
                                            </g>
                                            <g id="SvgjsG2270" class="apexcharts-datalabels" data:realIndex="0"></g>
                                        </g>
                                        <line id="SvgjsLine2292" x1="0" y1="0" x2="150"
                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                            class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine2293" x1="0" y1="0" x2="150"
                                            y2="0" stroke-dasharray="0" stroke-width="0"
                                            class="apexcharts-ycrosshairs-hidden"></line>
                                        <g id="SvgjsG2294" class="apexcharts-yaxis-annotations"></g>
                                        <g id="SvgjsG2295" class="apexcharts-xaxis-annotations"></g>
                                        <g id="SvgjsG2296" class="apexcharts-point-annotations"></g>
                                    </g>
                                    <g id="SvgjsG2281" class="apexcharts-yaxis" rel="0"
                                        transform="translate(-18, 0)"></g>
                                    <g id="SvgjsG2257" class="apexcharts-annotations"></g>
                                </svg>
                                <div class="apexcharts-legend"></div>
                                <div class="apexcharts-tooltip apexcharts-theme-dark">
                                    <div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker"
                                            style="background-color: rgb(121, 40, 202);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-label"></span><span
                                                    class="apexcharts-tooltip-text-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark">
                                    <div class="apexcharts-yaxistooltip-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="resize-triggers">
                            <div class="expand-trigger">
                                <div style="width: 432px; height: 41px;"></div>
                            </div>
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Button --}}
    <a href="{{ route('targeted-messages.all.create') }}" class="btn btn-primary mb-3">Create New Affiliate Campaign</a>
    {{-- End Button --}}

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Recipients</th>
                <th>Success</th>
                <th>Failure</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->title }}</td>
                    <td>{{ $message->recipients_count }}</td>
                    <td>{{ $message->success_count }}</td>
                    <td>{{ $message->failure_count }}</td>
                    <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $messages->links() }}
    </div>
@endsection
