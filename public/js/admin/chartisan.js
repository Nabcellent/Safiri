const LOADER = {
    color: '#000',
    size: [30, 30],
    type: 'bar',
    textColor: '#900',
    text: 'Loading chart data...',
}

const globalHooks = () => {
    return new ChartisanHooks()
        .responsive()
        .legend({position: 'bottom'})
}

// const randomScalingFactor = () => Math.round(Math.random() * 100)
const randomColorFactor = () => Math.round(Math.random() * 255);
const randomColor = opacity => {
    return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
};
const randomColors = (count, opacityDiff = 1) => {
    let colors = [],
        randomColor = `${randomColorFactor()}, ${randomColorFactor()}, ${randomColorFactor()}`;
    for (let i = 0; i < count; i++) {
        colors.push(`rgba(${randomColor}, ${1 - (i + opacityDiff) / 10})`)
    }

    return colors
}

const gradientColor = rgbColor => {
    let rgb = rgbColor.join()
    let gradient = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 0, 400);

    gradient.addColorStop(0, `rgba(${rgb}, 1)`);
    gradient.addColorStop(0.5, `rgba(${rgb}, .5)`);
    gradient.addColorStop(1, `rgba(${rgb}, 0)`);

    return gradient;
}

setInterval(() => {
    chart.users.update({background: true})
    chart.genderCount.update({background: true})
    chart.revenue.update({background: true})
}, 300000)

const chartFreqOptions = [
    {title: 'Hourly', value: 'hourly'},
    {title: 'Daily', value: 'daily'},
    {title: 'Weekly', value: 'weekly'},
    {title: 'Monthly', value: 'monthly'},
    {title: 'Yearly', value: 'yearly'},
    {title: 'All time', value: 'all-time'}
];

const chartConfigRefresh = () => {
    return `<button class="btn btn-sm btn-outline-blue-light ms-1 refresh-chart" type="button" title="Update Chart">
                <i class="fas fa-sync"></i>
            </button>
`;
}

const chartConfigSelects = () => {
    return `<select name="revenue" class="form-control form-control-sm chart-freq ms-1" aria-label="">
                <option hidden selected value="">Frequency</option>`
        + chartFreqOptions.map(opt => {
            return (`<option value=${opt.value}>${opt.title}</option>`)
        }) + `
            </select>
            ${chartConfigRefresh()}
`;
}

$('.chart-config.select').html(chartConfigSelects())
$('.chart-config.refresh-only').html(chartConfigRefresh())

$(document).on('click', '.refresh-chart', function () {
    const chartName = $(this).closest('.card-header').siblings().children().first().data('chartName'),
        chartInstance = chart[chartName];

    chartInstance.update()
})

$(document).on('change', '.chart-freq', function () {
    const chartName = $(this).closest('.card-header').siblings().children().first().data('chartName'),
        chartInstance = chart[chartName],
        chartInstanceUrl = chartInstance.options.url

    chartInstance.update({
        url: `${chartInstanceUrl}?frequency=${$(this).val()}`,
    })

    chartInstance.options.url = chartInstanceUrl
})
