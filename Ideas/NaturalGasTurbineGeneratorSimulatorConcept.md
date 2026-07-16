# Natural Gas Turbine Generator Simulator Concept

## Purpose
Create a desktop-only browser-based operator training simulator for a heavy-duty industrial natural gas-fired turbine generator.

## Platform
- Desktop browser only
- Fixed-size display (1920x1080 target)
- Multiple browser windows/pages may be open simultaneously
- One-second operator display updates
- Independent physics engine using natural process time constants

## Plant Configuration
- Heavy-duty industrial gas turbine
- Natural gas fuel
- Simple-cycle
- Single shaft
- No gearbox
- No turbine-generator clutch
- 2-pole synchronous generator
- 3600 RPM
- 60 Hz
- Approximately 65 MW output

## Main Displays
1. Plant Overview
2. Gas Turbine
3. Generator
4. Excitation & Synchronization
5. Transformer & Switchyard
6. Fuel Gas System
7. Lubrication & Hydraulic Systems
8. Cooling Systems
9. Engineering PID Controls
10. Trend Displays
11. Alarm & Event Summary
12. Startup / Shutdown Sequence
13. Maintenance & Diagnostics
14. Weather / Ambient Conditions
15. Simulation Control

## Control System
- Hierarchical control architecture
- Plant state machine
- Nested PID loops
- Outer loops:
  - Load Control
  - Speed Control
  - Temperature Control
  - Voltage Control
- Inner loops:
  - Fuel Flow
  - Fuel Valve Position
  - Airflow
  - Compressor Guide Vanes
  - Excitation
  - Hydraulic Actuators

## Startup Logic
- Permission-based sequencing
- Green light only when all permissives are satisfied
- Display missing permissives and explanatory messages
- Prevent progression until requirements are met

## Operator Functions
- Cold Start
- Warm Plant
- Synchronize to Grid
- Load Control
- Speed Control
- Voltage Control
- Emergency Shutdown

## Trending
- Four traces per chart
- Multiple trend pages
- Zoom
- Cursor measurements
- PID tuning support
- Historical playback

## Simulation Speed
- Pause
- 1x
- 2x
- 4x
- 8x
- 16x
- 32x
- 64x
- Preserve natural process dynamics while compressing simulation time

## Dynamic Modeling
Use realistic process dynamics rather than arbitrary delays.
Each process uses its own natural time constant.
Examples include:
- Fuel valve
- Governor
- Airflow
- Shaft acceleration
- Exhaust temperature
- Metal temperatures
- Bearing temperatures
- Lube oil temperatures
- Transformer temperatures

## Learning System
Every screen includes context-sensitive help.
Topics include:
- Gas turbine fundamentals
- Brayton cycle
- Generator operation
- Synchronization
- PID control
- Protective relaying
- Combustion
- Fuel systems
- Maintenance

Include guided tutorials and operator lessons so a beginner can learn to operate the plant while interacting with the simulator.
