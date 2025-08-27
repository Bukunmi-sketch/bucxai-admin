$(function() {
	'use strict';
    /** PIE CHART **/
	var datapie = {
		labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
		datasets: [{
			data: [35,24,20,15,8],
			backgroundColor: ['#e24934', '#ec82ef', '#3ec7e8', '#ffca4a', '#867efc', '#1cc8e3']
		}]
	};
	var optionpie = {
		maintainAspectRatio: false,
		responsive: true,
		plugins: {
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			tooltip: {
				enabled: true
			}
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	};
	// For a doughnut chart
	var ctx6 = document.getElementById('chartPie');
	var myPieChart6 = new Chart(ctx6, {
		type: 'doughnut',
		data: datapie,
		options: optionpie
	});
	// For a pie chart
	var ctx7 = document.getElementById('chartDonut');
	var myPieChart7 = new Chart(ctx7, {
		type: 'pie',
		data: datapie,
		options: optionpie
	});






	var ctx2 = document.getElementById('chartBar2').getContext('2d');
	new Chart(ctx2, {
		type: 'bar',
		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
			datasets: [{
				label: '# of Votes',
				data: [14, 12, 34, 25, 24, 20],
				backgroundColor: 'rgba(70, 127, 207, 0.5)'
			}]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			barPercentage: 0.5,
			plugins: {
				legend: {
					display: false,
					labels: {
						display: false
					}
				},
				tooltip: {
					enabled: true
				}
			},
			scales: {
				x: {
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						fontColor: "rgba(180, 183, 197, 0.4)",
					},
					title: {
						display: false,
						text: 'Months',
					},
					grid: {
						display: true,
						color: 'rgba(180, 183, 197, 0.4)																																					',
						drawBorder: false,
					},
				},
				y: {
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						fontColor: "rgba(180, 183, 197, 0.4)",
						stepSize: 10,
						min: 0,
						max: 80
					},
					title: {
						display: false,
						text: 'Revenue',
					},
					grid: {
						display: true,
						color: 'rgba(180, 183, 197, 0.4)',
						drawBorder: false,
					},
				}
			},
		}
	});

});
