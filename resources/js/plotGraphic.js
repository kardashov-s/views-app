window.d3 = require('d3');

window.plotGraphic = function plotGraphic(data, divId, color = 'steelblue', params = {daily: true, axis_y_right: false}) {
	const margin = {top: 10, right: 30, bottom: 30, left: 60},
    width = (params.width ?? 460) - margin.left - margin.right,
    height = (params.height ?? 200) - margin.top - margin.bottom;

	// append the svg object to the body of the page
	const svg = d3.select('#' + divId)
	  .append("svg")
	    .attr("width", width + margin.left + margin.right)
	    .attr("height", height + margin.top + margin.bottom)
	  .append("g")
	    .attr("transform", `translate(${margin.left},${margin.top})`);
  // transform date
  data = data.map(function (data) {
		data.date = params.daily ? d3.timeParse("%Y-%m-%d")(data.date) : d3.timeParse("%Y-%m-%d %H:%M:%S")(data.date);
		return data;
  });
	// Add X axis
	const x = d3.scaleTime()
	  .domain(d3.extent(data, function(d) { return d.date; }))
	  .range([ 0, width ]);
	svg.append("g")
	  .attr("transform", `translate(0, ${height})`)
		.call(d3
			.axisBottom(x)
			.ticks(data.length - 1 || 1)
			.tickFormat(
				d3.timeFormat(params.daily ? (data.length < 8 ? "%m-%d" : "%d") : "%m-%d %H:%M")
			)
		);

	// Add Y axis
	const y = d3.scaleLinear()
	  .domain([d3.min(data, function(d) { return + d.value; }), d3.max(data, function(d) { return + d.value; })])
	  .range([ height, 0 ]);
	svg.append("g")
	  .call(d3.axisLeft(y));
  if (params.axis_y_right) {
		const axisY = d3.select('#axis-y')
      .append("svg")
      .attr("width", margin.left + margin.right)
      .attr("height", height + margin.top + margin.bottom)
      .append("g")
      .attr("transform", `translate(${margin.left},${margin.top})`);
		axisY.append("g")
      .call(d3.axisRight(y));
  }

	// This allows to find the closest X index of the mouse:
	var bisect = d3.bisector(function(d) { return d.date; }).left;

	// Create the circle that travels along the curve of chart
	var focus = svg
	.append('g')
	.append('circle')
	  .style("fill", "none")
	  .attr("stroke", "black")
	  .attr('r', 8.5)
	  .style("opacity", 0)

	// Create the text that travels along the curve of chart
	var focusText = svg
	.append('g')
	.append('text')
	  .style("opacity", 0)
	  .attr("text-anchor", "left")
	  .attr("alignment-baseline", "middle")

	// Add the line
	svg.append("path")
	  .datum(data)
	  .attr("fill", "none")
	  .attr("stroke", color)
	  .attr("stroke-width", 1.5)
	  .attr("d", d3.line()
	    .x(function(d) { return x(d.date) })
	    .y(function(d) { return y(d.value) })
	    )

  if (data.length === 1) {
		svg
			.append('g')
			.append('rect')
			.style("fill", color)
			.attr('width', width / 10)
			.attr('height', height)
			.attr("x", width * 9 / 20)
  }
  // Create a rect on top of the svg area: this rectangle recovers mouse position
  svg
    .append('rect')
    .style("fill", "none")
    .style("pointer-events", "all")
    .attr('width', width)
    .attr('height', height)
    .on('mouseover', mouseover)
    .on('mousemove', mousemove)
    .on('mouseout', mouseout);

  // What happens when the mouse move -> show the annotations at the right positions.
  function mouseover() {
    focus.style("opacity", 1)
    focusText.style("opacity",1)
  }

  function mousemove() {
    // recover coordinate we need
    var x0 = x.invert(d3.mouse(this)[0]);
    var i = bisect(data, x0, 1);
    selectedData = data[i] ?? data[0]
    focus
      .attr("cx", x(selectedData.date))
      .attr("cy", y(selectedData.value))
    focusText
      .html(selectedData.value)
      .attr("x", x(selectedData.date) - 40)
      .attr("y", y(selectedData.value) + 4)
    }
  function mouseout() {
    focus.style("opacity", 0)
    focusText.style("opacity", 0)
  }
}
