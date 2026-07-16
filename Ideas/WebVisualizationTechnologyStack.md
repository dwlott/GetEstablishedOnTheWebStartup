# Web Visualization Technology Stack

## Recommended Stack

### Plant Graphics
- SVG for the plant mimic diagram.
- Animated shafts, valves, pumps, breakers, airflow, and fuel flow.
- Scalable, crisp graphics suitable for desktop HMIs.

### Charts and Trends
Preferred library: Apache ECharts.

Reasons:
- Engineering-quality trend displays.
- Four-trace trend charts.
- Live updates.
- Zoom and pan.
- Multiple Y axes.
- Bar charts.
- Gauges.
- Scatter plots.
- Excellent performance with hundreds of live process variables.

### Tables
Preferred library: AG Grid.

Use for:
- Alarm summary.
- Event log.
- PID tuning tables.
- I/O lists.
- Diagnostics.

Benefits:
- Very fast updates.
- Sorting.
- Filtering.
- Frozen columns.
- Excel-like navigation.

### Simulation Engine
- JavaScript/TypeScript.
- Physics engine.
- State machine.
- Nested PID controllers.
- Natural process time constants.

### Operator Interface
- HTML/CSS.
- Desktop only.
- Fixed-size layout.
- Multiple windows may be open simultaneously.

## Overall Architecture
SVG -> Plant Graphics
Apache ECharts -> Trends, Gauges, Charts
AG Grid -> Tables and Logs
HTML/CSS -> Operator Controls
JavaScript -> Physics, PID, State Machine

This stack is intended to support an industrial HMI-style natural gas turbine generator simulator with excellent performance and room for future expansion.