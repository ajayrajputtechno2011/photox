<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="PhotoX Photographer Custom Watermark Studio & Anti-Theft Branding Suite.">
  <title>PhotoX | Photographer Watermark Studio &amp; Protection</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <style>
    :root {
      --px-orange: #ff8a00;
      --px-orange-hover: #e06d00;
      --px-orange-light: rgba(255, 138, 0, 0.15);
    }

    /* Photographer Watermark Studio Shell */
    .wm-studio-container {
      background: #0b1a29;
      border: 1px solid #1a2f44;
      border-radius: 16px;
      padding: 24px;
      color: #f1f5f9;
      box-shadow: 0 10px 30px rgba(0,0,0,0.35);
      margin-bottom: 24px;
    }

    .wm-top-tabs {
      display: flex;
      gap: 8px;
      background: #060f18;
      padding: 6px;
      border-radius: 14px;
      border: 1px solid #1f374e;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }
    .wm-top-tab {
      flex: 1;
      min-width: 140px;
      border: none;
      background: transparent;
      padding: 10px 14px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.88rem;
      color: #94a3b8;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }
    .wm-top-tab .tab-status {
      font-size: 0.70rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-top: 2px;
      letter-spacing: 0.05em;
      color: #64748b;
    }
    .wm-top-tab.active {
      background: var(--px-orange);
      color: #ffffff;
      box-shadow: 0 2px 10px rgba(255, 138, 0, 0.4);
    }
    .wm-top-tab.active .tab-status {
      color: #ffffff;
    }

    /* Switch Component */
    .wm-switch {
      position: relative;
      display: inline-block;
      width: 48px;
      height: 26px;
    }
    .wm-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    .wm-slider {
      position: absolute;
      cursor: pointer;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: #1e354a;
      border: 1px solid #2f4b66;
      transition: .3s;
      border-radius: 34px;
    }
    .wm-slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: #cbd5e1;
      transition: .3s;
      border-radius: 50%;
    }
    input:checked + .wm-slider {
      background-color: var(--px-orange);
      border-color: var(--px-orange);
    }
    input:checked + .wm-slider:before {
      transform: translateX(22px);
      background-color: #ffffff;
    }

    /* Watermark Type Segmented Control */
    .wm-type-btn-group {
      display: flex;
      background: #060f18;
      padding: 6px;
      border-radius: 12px;
      border: 1px solid #1f374e;
      gap: 6px;
    }
    .wm-type-btn {
      flex: 1;
      border: 1px solid #1e354a;
      background: #0a1622;
      padding: 10px 12px;
      border-radius: 9px;
      font-weight: 700;
      font-size: 0.88rem;
      color: #cbd5e1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      cursor: pointer;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .wm-type-btn i {
      font-size: 1.05rem;
      color: #94a3b8;
    }
    .wm-type-btn:hover {
      background: #112234;
      border-color: #ff8a00;
      color: #fff;
    }
    .wm-type-btn.active {
      background: linear-gradient(135deg, #ff8a00 0%, #ea580c 100%) !important;
      color: #ffffff !important;
      border-color: #ea580c !important;
      font-weight: 800;
      box-shadow: 0 4px 14px rgba(255, 138, 0, 0.42) !important;
    }
    .wm-type-btn.active i {
      color: #ffffff !important;
    }

    /* Range Sliders */
    .wm-range-slider {
      -webkit-appearance: none;
      width: 100%;
      height: 6px;
      border-radius: 5px;
      background: #192d40;
      outline: none;
    }
    .wm-range-slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: var(--px-orange);
      cursor: pointer;
      box-shadow: 0 1px 6px rgba(0,0,0,0.5);
      transition: transform 0.1s;
    }
    .wm-range-slider::-webkit-slider-thumb:hover {
      transform: scale(1.15);
    }

    /* Density Group */
    .wm-density-btn-group {
      display: flex;
      background: #060f18;
      padding: 4px;
      border-radius: 10px;
      gap: 4px;
      border: 1px solid #1f374e;
    }
    .wm-density-btn {
      flex: 1;
      background: transparent;
      border: 1px solid transparent;
      padding: 6px 8px;
      border-radius: 8px;
      cursor: pointer;
      text-align: center;
      font-size: 0.8rem;
      color: #94a3b8;
      transition: all 0.2s ease;
    }
    .wm-density-btn:hover {
      background: #102131;
      color: #fff;
    }
    .wm-density-btn.active {
      background: #15293d;
      border-color: #ff8a00;
      color: #ff8a00 !important;
      font-weight: 700;
    }
    .wm-density-btn.active small {
      color: #ffaa33 !important;
      font-weight: 600;
    }

    /* Upload & Thumbnail Boxes */
    .wm-logo-box {
      width: 70px;
      height: 70px;
      border-radius: 10px;
      background: #060f18;
      border: 2px dashed #203548;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }
    .wm-logo-box img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    /* Cards inside controls */
    .wm-inner-card {
      background: #081420;
      border: 1px solid #192d40;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 16px;
    }

    .form-control, .form-select {
      background: #060f18 !important;
      border: 1px solid #1e354a !important;
      color: #f1f5f9 !important;
      border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--px-orange) !important;
      box-shadow: 0 0 0 2px rgba(255, 138, 0, 0.25) !important;
    }

    /* Live Preview Stage & Overlays */
    .wm-preview-wrapper {
      position: relative;
      background: #000;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 10px 35px rgba(0,0,0,0.6);
      user-select: none;
      aspect-ratio: 16/10;
      max-height: 540px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #1f374e;
    }
    .wm-preview-wrapper .base-photo {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      pointer-events: none;
    }

    /* Continuous Anti-AI Security Wires */
    .wm-anti-ai-lines-svg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 8;
      display: none;
      transition: opacity 0.2s ease;
    }

    /* Watermark Grid Overlay */
    .wm-watermark-overlay {
      position: absolute;
      inset: 0;
      display: grid;
      grid-template-columns: repeat(9, 1fr);
      grid-template-rows: repeat(6, 1fr);
      pointer-events: none;
      overflow: hidden;
      z-index: 10;
    }
    .wm-watermark-item {
      display: flex;
      align-items: center;
      justify-content: center;
      transform-origin: center center;
      white-space: nowrap;
      user-select: none;
      padding: 2px;
      transition: transform 0.15s ease;
    }

    /* Single Large Center Box */
    .wm-single-large-box {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%) rotate(var(--wm-single-rot, -12deg));
      z-index: 12;
      pointer-events: none;
      text-align: center;
      display: none;
      filter: drop-shadow(0 2px 10px rgba(0,0,0,0.6));
    }
    .wm-single-large-box.active {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    /* PhotoX Pro Overlay */
    .wm-fotto-pro-layer {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 11;
      display: none;
    }
    .wm-fotto-pro-layer.active {
      display: block;
    }
    .wm-diagonal-cross-svg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }
    .wm-corner-mark {
      position: absolute;
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: 13px;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      color: var(--px-orange);
      text-shadow: 0 1px 4px rgba(0,0,0,0.8);
      opacity: 0.85;
    }
    .wm-corner-tl { top: 16px; left: 16px; }
    .wm-corner-tr { top: 16px; right: 16px; }
    .wm-corner-bl { bottom: 16px; left: 16px; }
    .wm-corner-br { bottom: 16px; right: 16px; }

    .wm-fotto-vertical-ribbon {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%) rotate(-90deg);
      transform-origin: center center;
      font-family: 'Space Grotesk', sans-serif;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.25em;
      text-transform: uppercase;
      color: var(--px-orange);
      white-space: nowrap;
      opacity: 0.75;
    }
    .wm-fotto-center-box {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%) rotate(-12deg);
      text-align: center;
      pointer-events: none;
      z-index: 12;
    }
    .wm-fotto-center-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 42px;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--px-orange);
      text-shadow: 0 3px 12px rgba(0,0,0,0.9), 0 0 20px rgba(255,138,0,0.3);
      line-height: 1;
    }
    .wm-fotto-security-badge {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      background: rgba(15, 23, 42, 0.85);
      border: 1px solid var(--px-orange);
      color: #ffffff;
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      backdrop-filter: blur(4px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.5);
      pointer-events: none;
    }

    /* Double X-Cross Shield */
    .wm-double-cross-layer {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 11;
      display: none;
    }
    .wm-double-cross-layer.active {
      display: block;
    }
    .wm-double-cross-center {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      z-index: 12;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: rgba(15, 23, 42, 0.55);
      padding: 16px 24px;
      border-radius: 50%;
      border: 2px dashed var(--px-orange);
      backdrop-filter: blur(2px);
      box-shadow: 0 4px 20px rgba(0,0,0,0.5);
    }

    /* Hex Mesh Layer */
    .wm-hex-mesh-layer {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 11;
      display: none;
    }
    .wm-hex-mesh-layer.active {
      display: block;
    }

    /* Quad Corners Anti-Crop Layer */
    .wm-quad-corners-layer {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 11;
      display: none;
    }
    .wm-quad-corners-layer.active {
      display: block;
    }
    .wm-bracket {
      position: absolute;
      width: 45px;
      height: 45px;
      border-color: var(--px-orange);
      border-style: solid;
      opacity: 0.85;
    }
    .wm-bracket-tl { top: 18px; left: 18px; border-width: 3px 0 0 3px; }
    .wm-bracket-tr { top: 18px; right: 18px; border-width: 3px 3px 0 0; }
    .wm-bracket-bl { bottom: 18px; left: 18px; border-width: 0 0 3px 3px; }
    .wm-bracket-br { bottom: 18px; right: 18px; border-width: 0 3px 3px 0; }

    /* Post-Purchase Sponsor Layer */
    .wm-sponsor-layer {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 25;
      display: none;
    }
    .wm-sponsor-badge-box {
      position: absolute;
      transition: all 0.2s ease;
      filter: drop-shadow(0 3px 10px rgba(0,0,0,0.6));
    }
    .wm-sponsor-badge-box img {
      display: block;
      height: auto;
      width: auto;
      max-width: 100%;
      object-fit: contain;
    }
    .placement-bottom_right { bottom: var(--sponsor-margin, 0px); right: var(--sponsor-margin, 0px); }
    .placement-bottom_left { bottom: var(--sponsor-margin, 0px); left: var(--sponsor-margin, 0px); }
    .placement-top_right { top: var(--sponsor-margin, 0px); right: var(--sponsor-margin, 0px); }
    .placement-top_left { top: var(--sponsor-margin, 0px); left: var(--sponsor-margin, 0px); }
    .placement-middle_bottom { bottom: var(--sponsor-margin, 0px); left: 50%; transform: translateX(-50%); }

    /* Download Protection Mosaic Grid */
    .wm-download-protection-layer {
      position: absolute;
      inset: 0;
      display: none;
      grid-template-columns: repeat(6, 1fr);
      grid-template-rows: repeat(4, 1fr);
      pointer-events: none;
      z-index: 15;
    }
    .wm-download-protection-layer.active {
      display: grid;
    }
    .wm-protection-tile {
      border: 0.5px solid rgba(255,255,255,0.04);
    }

    /* WaterMotion & Liquid Glass Lens System */
    .wm-motion-mask-layer {
      position: absolute;
      inset: 0;
      display: none;
      pointer-events: none;
      z-index: 25;
      overflow: hidden;
    }
    .wm-motion-mask-layer.active {
      display: block;
    }
    .wm-water-lens {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
      user-select: none;
      will-change: transform, left, top;
      transform-origin: center center;
      box-sizing: border-box;
      transition: width 0.25s ease, height 0.25s ease;
    }
    .wm-water-lens-primary {
      width: var(--water-lens-size, 190px);
      height: var(--water-lens-size, 190px);
      top: 35%;
      left: 45%;
      animation: waterMotionFloat1 var(--water-motion-speed, 10s) cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite alternate;
    }
    .wm-water-lens-secondary {
      width: calc(var(--water-lens-size, 190px) * 0.68);
      height: calc(var(--water-lens-size, 190px) * 0.68);
      top: 58%;
      left: 22%;
      animation: waterMotionFloat2 calc(var(--water-motion-speed, 10s) * 0.85) cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite alternate;
    }
    .wm-lens-inner-glass {
      position: absolute;
      inset: 0;
      border-radius: 50%;
      background: radial-gradient(circle at 35% 30%, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0.08) 50%, rgba(56, 189, 248, 0.12) 75%, rgba(255, 255, 255, 0.3) 100%);
      backdrop-filter: blur(var(--water-lens-blur, 1.2px)) contrast(1.18) saturate(1.22) brightness(1.06);
      -webkit-backdrop-filter: blur(var(--water-lens-blur, 1.2px)) contrast(1.18) saturate(1.22) brightness(1.06);
      border: 2px solid rgba(255, 255, 255, 0.85);
      box-shadow: 
        inset 0 0 25px rgba(255, 255, 255, 0.6),
        inset 3px 5px 16px rgba(255, 255, 255, 0.95),
        inset -2px -4px 14px rgba(186, 230, 253, 0.45),
        0 14px 38px rgba(0, 0, 0, 0.28),
        0 0 16px rgba(56, 189, 248, 0.35);
    }
    .wm-lens-glint {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
    }
    .wm-lens-glint-top {
      top: 8%;
      left: 14%;
      width: 46%;
      height: 28%;
      background: radial-gradient(ellipse at 40% 30%, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.6) 45%, rgba(255, 255, 255, 0) 80%);
      transform: rotate(-32deg);
      filter: blur(0.5px);
    }
    .wm-lens-glint-bottom {
      bottom: 11%;
      right: 15%;
      width: 34%;
      height: 18%;
      background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0.25) 50%, rgba(255, 255, 255, 0) 80%);
      transform: rotate(-18deg);
      filter: blur(0.5px);
    }
    .wm-lens-ring {
      position: absolute;
      inset: 3px;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, 0.4);
      opacity: 0.85;
      pointer-events: none;
    }
    .wm-water-ripple-layer {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      transform: translate(-50%, -50%);
      pointer-events: none;
    }
    .wm-ripple-ring {
      position: absolute;
      top: 50%;
      left: 50%;
      border-radius: 50%;
      border: 2px solid rgba(255, 255, 255, 0.6);
      box-shadow: 0 0 16px rgba(56, 189, 248, 0.4), inset 0 0 16px rgba(255, 255, 255, 0.3);
      transform: translate(-50%, -50%) scale(0.2);
      opacity: 0;
      pointer-events: none;
    }
    .wm-ripple-ring.ring-1 { width: 280px; height: 280px; animation: rippleWave 4s cubic-bezier(0.25, 1, 0.5, 1) infinite; }
    .wm-ripple-ring.ring-2 { width: 280px; height: 280px; animation: rippleWave 4s cubic-bezier(0.25, 1, 0.5, 1) infinite 1.35s; }
    .wm-ripple-ring.ring-3 { width: 280px; height: 280px; animation: rippleWave 4s cubic-bezier(0.25, 1, 0.5, 1) infinite 2.7s; }
    @keyframes rippleWave {
      0% { transform: translate(-50%, -50%) scale(0.2); opacity: 0.9; }
      70% { opacity: 0.35; }
      100% { transform: translate(-50%, -50%) scale(2.4); opacity: 0; }
    }
    @keyframes waterMotionFloat1 {
      0% { transform: translate(0, 0) scale(1) rotate(0deg); }
      25% { transform: translate(85px, -50px) scale(1.06) rotate(4deg); }
      50% { transform: translate(130px, 45px) scale(0.96) rotate(-3deg); }
      75% { transform: translate(-70px, 65px) scale(1.05) rotate(5deg); }
      100% { transform: translate(-35px, -40px) scale(0.98) rotate(-4deg); }
    }
    @keyframes waterMotionFloat2 {
      0% { transform: translate(0, 0) scale(1) rotate(0deg); }
      33% { transform: translate(-95px, -65px) scale(1.08) rotate(-5deg); }
      66% { transform: translate(65px, -35px) scale(0.94) rotate(4deg); }
      100% { transform: translate(35px, 75px) scale(1.05) rotate(-3deg); }
    }

    /* Save Button */
    .btn-save-settings {
      background: var(--px-orange);
      color: #ffffff;
      border: none;
      padding: 12px 24px;
      border-radius: 10px;
      font-weight: 700;
      font-size: 0.95rem;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(255, 138, 0, 0.4);
      transition: all 0.2s ease;
    }
    .btn-save-settings:hover {
      background: var(--px-orange-hover);
      transform: translateY(-1px);
      color: #fff;
    }

    /* Color Swatches */
    .wm-color-swatch-btn {
      width: 30px;
      height: 30px;
      border-radius: 8px;
      border: 2px solid transparent;
      padding: 0;
      cursor: pointer;
      font-size: 0;
      transition: transform 0.15s, border-color 0.15s;
    }
    .wm-color-swatch-btn:hover {
      transform: scale(1.15);
    }
    .wm-color-swatch-btn.active {
      border-color: #fff;
      transform: scale(1.15);
      box-shadow: 0 0 0 2px rgba(255, 138, 0, 0.6);
    }

    /* ========================================================
       RESPONSIVE & MOBILE-FIRST STYLES (Studio & Layout)
       ======================================================== */
    @media (max-width: 991px) {
      body.page-photographer-gallery .photographer-shell {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
        padding-top: 14px !important;
        padding-bottom: 30px !important;
      }
      .photographer-sidebar {
        padding: 16px 14px !important;
        border-radius: 14px !important;
      }
      .photographer-sidebar .workspace-greeting {
        margin-bottom: 10px !important;
      }
      .photographer-sidebar h1 {
        font-size: 1.5rem !important;
        line-height: 1 !important;
        margin: 6px 0 12px !important;
      }
      .workspace-nav {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 6px !important;
      }
      .workspace-nav-link {
        flex: 1 1 calc(33.333% - 6px) !important;
        min-width: 120px !important;
        padding: 8px 10px !important;
        font-size: 0.82rem !important;
        border-radius: 8px !important;
        justify-content: center !important;
      }
      .workspace-side-note {
        display: none !important;
      }
      .workspace-logout {
        margin-top: 10px !important;
        padding: 8px 12px !important;
        font-size: 0.82rem !important;
        display: inline-block !important;
      }
    }

    @media (max-width: 767px) {
      .workspace-topbar {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 12px !important;
      }
      .workspace-topbar .d-flex {
        width: 100% !important;
        flex-direction: column !important;
        gap: 8px !important;
      }
      .workspace-topbar .btn {
        width: 100% !important;
        text-align: center !important;
        justify-content: center !important;
        font-size: 0.82rem !important;
      }

      .wm-studio-container {
        padding: 14px 10px !important;
        border-radius: 14px !important;
      }
      .wm-inner-card {
        padding: 14px 10px !important;
      }

      .wm-top-tabs {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 6px !important;
        padding: 4px !important;
        border-radius: 12px !important;
      }
      .wm-top-tab {
        min-width: 0 !important;
        padding: 8px 6px !important;
        font-size: 0.78rem !important;
        text-align: center !important;
      }
      .wm-top-tab span {
        line-height: 1.2 !important;
        white-space: normal !important;
      }
      .wm-top-tab .tab-status {
        font-size: 0.65rem !important;
      }

      .preview-mode-bar {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 8px !important;
      }
      .preview-mode-bar .btn-group {
        width: 100% !important;
        display: flex !important;
      }
      .preview-mode-bar .btn-group .btn {
        flex: 1 1 50% !important;
        font-size: 0.75rem !important;
        padding: 6px 4px !important;
        white-space: normal !important;
        line-height: 1.2 !important;
      }
      .preview-mode-badge {
        text-align: center !important;
        width: 100% !important;
      }

      .wm-preview-wrapper {
        border-radius: 10px !important;
        max-height: 380px !important;
      }
    }

    @media (max-width: 480px) {
      .workspace-nav-link {
        flex: 1 1 calc(50% - 6px) !important;
        min-width: 100px !important;
        font-size: 0.78rem !important;
      }
      .wm-type-btn {
        font-size: 0.76rem !important;
        padding: 8px 4px !important;
        gap: 4px !important;
      }
      .wm-type-btn i {
        font-size: 0.9rem !important;
      }
      .wm-density-btn {
        padding: 5px 3px !important;
        font-size: 0.72rem !important;
      }
      .wm-density-btn strong {
        font-size: 0.72rem !important;
      }
      .wm-density-btn small {
        font-size: 0.62rem !important;
      }
      .btn-save-settings {
        font-size: 0.88rem !important;
        padding: 10px 14px !important;
      }
    }
  </style>
</head>
<body class="page-photographer-gallery">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a class="navbar-brand d-flex align-items-center gap-2" href="/"><img alt="PhotoX" src="{{ asset('logo.png') }}"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/events">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="/photographers">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="/membership">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <div class="account-menu">
            <button class="profile-trigger" aria-label="Open account menu">
              <span class="avatar">{{ strtoupper(substr($photographer->name, 0, 2)) }}</span>
              <span class="d-none d-sm-inline">{{ $photographer->name }}</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="container-xl photographer-shell">
    <aside class="photographer-sidebar" aria-label="Photographer navigation">
      <div class="workspace-greeting">
        <span class="eyebrow-blue">PHOTOGRAPHER WORKSPACE</span>
        <h1>Watermark<br><em>Studio.</em></h1>
      </div>
      <nav class="workspace-nav">
        <a class="workspace-nav-link" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Events</span></a>
        <a class="workspace-nav-link" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link active" href="/photographer-watermark"><i class="bi bi-shield-lock"></i><span>Watermark Studio</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
        <a class="workspace-nav-link" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note">
        <i class="bi bi-shield-shaded text-warning"></i>
        <div>
          <strong>Brand Protection</strong>
          <span>High-density anti-AI watermarks &amp; sponsor branding for your photo sales.</span>
        </div>
      </div>
      <a class="workspace-logout" href="/"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">CREATOR BRANDING &amp; DEFENSE</span>
          <h2>Photographer Watermark Studio</h2>
        </div>
        <div class="d-flex gap-2">
          @if($hasCustomWatermark)
            <form action="{{ route('photographer.watermark.reset') }}" method="POST" onsubmit="return confirm('Reset to platform default watermark?');">
              @csrf
              <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset to Admin Default
              </button>
            </form>
          @endif
          <a class="btn btn-outline-light rounded-pill px-3" href="/photographer-gallery"><i class="bi bi-images me-1"></i>My Galleries</a>
        </div>
      </div>

      <!-- System Fallback Status Notification -->
      @if($hasCustomWatermark)
        <div class="alert alert-success d-flex align-items-center justify-content-between mb-4 border-0 rounded-4" style="background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3) !important;">
          <div class="d-flex align-items-center gap-3">
            <i class="bi bi-patch-check-fill fs-3"></i>
            <div>
              <strong>Custom Photographer Watermark Active</strong>
              <div class="small text-white-50">All photos uploaded to your galleries are protected with your custom photographer branding suite.</div>
            </div>
          </div>
          <span class="badge bg-success text-dark fw-bold">ACTIVE</span>
        </div>
      @else
        <div class="alert alert-warning d-flex align-items-center justify-content-between mb-4 border-0 rounded-4" style="background: rgba(255, 138, 0, 0.15); color: #ffaa33; border: 1px solid rgba(255, 138, 0, 0.3) !important;">
          <div class="d-flex align-items-center gap-3">
            <i class="bi bi-shield-exclamation fs-3"></i>
            <div>
              <strong>Using PhotoX Platform Default Watermark</strong>
              <div class="small text-white-50">You haven't saved a custom watermark yet. Your galleries currently fallback to the global PhotoX platform watermark. Customize below to activate your own branding!</div>
            </div>
          </div>
          <span class="badge bg-warning text-dark fw-bold">ADMIN FALLBACK</span>
        </div>
      @endif

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 rounded-4" role="alert" style="background: rgba(16, 185, 129, 0.15); color: #34d399;">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Full Watermark Studio Suite -->
      <div class="wm-studio-container">
        <!-- Top 4 Large Tabs -->
        <div class="wm-top-tabs">
          <button class="wm-top-tab active" id="tabWatermarkBtn" type="button" onclick="switchMainTab('watermark')">
            <span>Pre-Purchase Protection</span>
            <span class="tab-status" id="tabWatermarkStatusBadge">{{ ($setting->is_watermark_enabled ?? true) ? 'ON' : 'OFF' }}</span>
          </button>
          <button class="wm-top-tab" id="tabPostPurchaseBtn" type="button" onclick="switchMainTab('post_purchase')">
            <span>Post-Purchase Branding</span>
            <span class="tab-status" id="tabPostPurchaseStatusBadge">{{ ($setting->is_post_purchase_enabled ?? true) ? 'ON' : 'OFF' }}</span>
          </button>
          <button class="wm-top-tab" id="tabDownloadBtn" type="button" onclick="switchMainTab('download')">
            <span>Download Defense</span>
            <span class="tab-status" id="tabDownloadStatusBadge">{{ ($setting->is_download_protection_enabled ?? true) ? 'ON' : 'OFF' }}</span>
          </button>
          <button class="wm-top-tab" id="tabMotionBtn" type="button" onclick="switchMainTab('motion')">
            <span>WaterMotion / Glass Lens</span>
            <span class="tab-status" id="tabMotionStatusBadge">{{ ($setting->is_motion_mask_enabled ?? false) ? 'ON' : 'OFF' }}</span>
          </button>
        </div>

        <div class="row g-4">
          <!-- ============================================== -->
          <!-- LEFT COLUMN: CONTROLS & SETTINGS               -->
          <!-- ============================================== -->
          <div class="col-lg-5 order-2 order-lg-1">
            <!-- TAB 1: PRE-PURCHASE WATERMARK SETTINGS -->
            <div id="tabPanelWatermark">
              <!-- Enable watermark toggle -->
              <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background: #081420; border: 1px solid #192d40;">
                <div>
                  <h4 class="h6 fw-bold mb-1 text-white">Enable Pre-Purchase Watermark</h4>
                  <p class="text-white-50 small mb-0">Overlay protection marks on album photos before purchase.</p>
                </div>
                <label class="wm-switch">
                  <input type="checkbox" id="enableWatermarkToggle" {{ ($setting->is_watermark_enabled ?? true) ? 'checked' : '' }} onchange="onWatermarkToggleChange()">
                  <span class="wm-slider"></span>
                </label>
              </div>

              <!-- Watermark Coverage Pattern Selection (6 Modern Styles) -->
              <div class="wm-inner-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <label class="fw-bold small text-uppercase text-white-50 mb-0">Watermark Coverage Pattern</label>
                  <span class="badge bg-dark text-warning border border-warning font-monospace px-2 py-1" id="activePatternBadge">PhotoX Pro Grid</span>
                </div>
                <div class="row g-2 mb-2">
                  <div class="col-6 col-sm-4">
                    <button type="button" class="btn btn-sm w-100 text-truncate {{ ($setting->watermark_pattern ?? 'fotto_pro') === 'fotto_pro' ? 'btn-warning fw-bold text-dark' : 'btn-outline-secondary' }}" id="patternFottoProBtn" onclick="setWatermarkPattern('fotto_pro')" title="PhotoX Pro Grid">
                      <i class="bi bi-shield-shaded me-1"></i> PhotoX Pro
                    </button>
                  </div>
                  <div class="col-6 col-sm-4">
                    <button type="button" class="btn btn-sm w-100 text-truncate {{ ($setting->watermark_pattern ?? 'fotto_pro') === 'tiled' ? 'btn-warning fw-bold text-dark' : 'btn-outline-secondary' }}" id="patternTiledBtn" onclick="setWatermarkPattern('tiled')" title="Tiled Matrix">
                      <i class="bi bi-grid-3x3 me-1"></i> Tiled Grid
                    </button>
                  </div>
                  <div class="col-6 col-sm-4">
                    <button type="button" class="btn btn-sm w-100 text-truncate {{ ($setting->watermark_pattern ?? 'fotto_pro') === 'single_large' ? 'btn-warning fw-bold text-dark' : 'btn-outline-secondary' }}" id="patternSingleLargeBtn" onclick="setWatermarkPattern('single_large')" title="Single Hero Center">
                      <i class="bi bi-bullseye me-1"></i> Hero Center
                    </button>
                  </div>
                  <div class="col-6 col-sm-4">
                    <button type="button" class="btn btn-sm w-100 text-truncate {{ ($setting->watermark_pattern ?? 'fotto_pro') === 'double_cross' ? 'btn-warning fw-bold text-dark' : 'btn-outline-secondary' }}" id="patternDoubleCrossBtn" onclick="setWatermarkPattern('double_cross')" title="Double X-Cross Shield">
                      <i class="bi bi-x-octagon me-1"></i> X-Cross
                    </button>
                  </div>
                  <div class="col-6 col-sm-4">
                    <button type="button" class="btn btn-sm w-100 text-truncate {{ ($setting->watermark_pattern ?? 'fotto_pro') === 'hex_mesh' ? 'btn-warning fw-bold text-dark' : 'btn-outline-secondary' }}" id="patternHexMeshBtn" onclick="setWatermarkPattern('hex_mesh')" title="Hex Mesh Security Web">
                      <i class="bi bi-hexagon me-1"></i> Hex Mesh
                    </button>
                  </div>
                  <div class="col-6 col-sm-4">
                    <button type="button" class="btn btn-sm w-100 text-truncate {{ ($setting->watermark_pattern ?? 'fotto_pro') === 'quad_corners' ? 'btn-warning fw-bold text-dark' : 'btn-outline-secondary' }}" id="patternQuadCornersBtn" onclick="setWatermarkPattern('quad_corners')" title="Quad Corner Anti-Crop">
                      <i class="bi bi-bounding-box me-1"></i> Quad Crop
                    </button>
                  </div>
                </div>
                <small class="text-white-50 d-block" id="patternDescriptionText">
                  PhotoX Pro multi-point branding with cross-lines and corner defense.
                </small>
              </div>

              <!-- Watermark Content Type: Text | Logo | Both -->
              <div class="wm-inner-card border-warning-subtle">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <label class="fw-bold small text-uppercase text-white d-flex align-items-center gap-2 mb-0">
                    <span class="badge bg-warning text-dark"><i class="bi bi-ui-radios-grid"></i></span>
                    <span>Watermark Content Type</span>
                  </label>
                  <span class="badge bg-dark text-warning border border-warning font-monospace small px-2 py-1">Mode Selection</span>
                </div>
                <div class="wm-type-btn-group">
                  <button class="wm-type-btn {{ ($setting->watermark_type ?? 'both') === 'text' ? 'active' : '' }}" id="typeTextBtn" type="button" onclick="setWatermarkType('text')">
                    <i class="bi bi-fonts"></i>
                    <span>Text</span>
                  </button>
                  <button class="wm-type-btn {{ ($setting->watermark_type ?? 'both') === 'logo' ? 'active' : '' }}" id="typeLogoBtn" type="button" onclick="setWatermarkType('logo')">
                    <i class="bi bi-image"></i>
                    <span>Logo</span>
                  </button>
                  <button class="wm-type-btn {{ ($setting->watermark_type ?? 'both') === 'both' ? 'active' : '' }}" id="typeBothBtn" type="button" onclick="setWatermarkType('both')">
                    <i class="bi bi-layers-fill"></i>
                    <span>Both (Logo + Text)</span>
                  </button>
                </div>
              </div>

              <!-- Anti-AI Defense & Watermark Density Suite -->
              <div class="wm-inner-card" style="border-color: rgba(239, 68, 68, 0.4); background: linear-gradient(180deg, #0d1a27 0%, #151016 100%);">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <label class="fw-bold small text-uppercase text-danger d-flex align-items-center gap-2 mb-0">
                    <span class="badge bg-danger text-white"><i class="bi bi-shield-shaded"></i></span>
                    <span>Anti-AI Defense &amp; Watermark Density</span>
                  </label>
                  <span class="badge bg-danger-subtle text-danger border border-danger-subtle font-monospace small px-2 py-1">AI Eraser Proof</span>
                </div>
                <p class="text-white-50 small mb-2" style="font-size: 0.78rem;">
                  Boost quantity and activate continuous security wires so AI inpainting &amp; Magic Eraser tools cannot reconstruct original photo pixels.
                </p>

                <!-- Density Segmented Selector -->
                <label class="fw-bold text-white small d-block mb-1">Watermark Quantity &amp; Coverage Density</label>
                <div class="wm-density-btn-group mb-2">
                  <button type="button" class="wm-density-btn" id="densityMediumBtn" onclick="setWatermarkDensity('medium')">
                    <strong>Standard</strong>
                    <small class="d-block text-white-50">35 Marks</small>
                  </button>
                  <button type="button" class="wm-density-btn active" id="densityHighBtn" onclick="setWatermarkDensity('high')">
                    <strong>High Density</strong>
                    <small class="d-block text-danger">54 Marks (Anti-AI)</small>
                  </button>
                  <button type="button" class="wm-density-btn" id="densityUltraBtn" onclick="setWatermarkDensity('ultra')">
                    <strong>Ultra Fortress</strong>
                    <small class="d-block text-white-50">96 Marks (Max)</small>
                  </button>
                </div>

                <!-- Anti-AI Half-Frost Shield (Hover to Reveal) Toggle -->
                <div class="form-check form-switch mb-2 d-flex align-items-center justify-content-between ps-0 pe-1">
                  <label class="form-check-label small fw-semibold text-white mb-0" for="antiAiLinesToggle">
                    <i class="bi bi-shield-shaded me-1 text-danger"></i> Anti-AI Half-Frost Shield (Hover to Reveal)
                    <small class="d-block text-white-50" style="font-size: 0.73rem;">Enables or disables the diagonal frosted blur half on event photo previews</small>
                  </label>
                  <input class="form-check-input ms-0" type="checkbox" role="switch" id="antiAiLinesToggle" {{ ($setting->has_anti_ai_lines ?? true) ? 'checked' : '' }} onchange="updateLivePreview()" style="width: 2.4em; height: 1.25em;">
                </div>

                <!-- Anti-AI Micro-Copyright Pattern Toggle -->
                <div class="form-check form-switch d-flex align-items-center justify-content-between ps-0 pe-1">
                  <label class="form-check-label small fw-semibold text-white mb-0" for="antiAiMicroTextToggle">
                    <i class="bi bi-shield-lock me-1 text-danger"></i> Anti-AI Micro-Text Interlock
                    <small class="d-block text-white-50" style="font-size: 0.73rem;">Staggered "DO NOT COPY • PHOTOX" micro-labels</small>
                  </label>
                  <input class="form-check-input ms-0" type="checkbox" role="switch" id="antiAiMicroTextToggle" checked onchange="updateLivePreview()" style="width: 2.4em; height: 1.25em;">
                </div>
              </div>

              <!-- Color Adjustment Suite -->
              <div class="wm-inner-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <label class="fw-bold small text-uppercase text-white-50 mb-0">Brand &amp; Text Color</label>
                  <span class="badge bg-dark text-warning border border-warning font-monospace px-2 py-1" id="activeColorHexDisplay">#FF8A00</span>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                  <div class="position-relative d-inline-block" title="Pick any custom color">
                    <input type="color" id="customColorPicker" value="{{ str_starts_with($setting->watermark_color ?? '', '#') ? $setting->watermark_color : '#ff8a00' }}" class="form-control form-control-color border-0 p-0" style="width: 38px; height: 38px; border-radius: 8px; cursor: pointer;" oninput="onCustomColorChange(this.value)">
                  </div>
                  <button type="button" class="btn btn-sm wm-color-swatch-btn active" style="background:#ff8a00;" onclick="setCustomHexColor('#ff8a00')" title="PhotoX Orange"></button>
                  <button type="button" class="btn btn-sm wm-color-swatch-btn" style="background:#ffffff; border: 1px solid #cbd5e1;" onclick="setCustomHexColor('#ffffff')" title="Crisp White"></button>
                  <button type="button" class="btn btn-sm wm-color-swatch-btn" style="background:#facc15;" onclick="setCustomHexColor('#facc15')" title="Vibrant Yellow"></button>
                  <button type="button" class="btn btn-sm wm-color-swatch-btn" style="background:#a3e635;" onclick="setCustomHexColor('#a3e635')" title="Neon Lime"></button>
                  <button type="button" class="btn btn-sm wm-color-swatch-btn" style="background:#06b6d4;" onclick="setCustomHexColor('#06b6d4')" title="Electric Cyan"></button>
                  <button type="button" class="btn btn-sm wm-color-swatch-btn" style="background:#ef4444;" onclick="setCustomHexColor('#ef4444')" title="Crimson Red"></button>
                  <button type="button" class="btn btn-sm wm-color-swatch-btn" style="background:#1e293b;" onclick="setCustomHexColor('#1e293b')" title="Stealth Dark"></button>
                </div>
                <div class="input-group input-group-sm" style="max-width: 180px;">
                  <span class="input-group-text bg-dark border-secondary text-white-50">#</span>
                  <input type="text" class="form-control font-monospace" id="customColorHexInput" value="{{ ltrim(str_starts_with($setting->watermark_color ?? '', '#') ? $setting->watermark_color : 'FF8A00', '#') }}" maxlength="6" oninput="onHexTextInput(this.value)">
                </div>
              </div>

              <!-- DEDICATED SLIDER FOR SINGLE LARGE WATERMARK -->
              <div id="singleLargeWatermarkControls" class="wm-inner-card" style="border-color: rgba(255, 138, 0, 0.5); display: {{ ($setting->watermark_pattern ?? 'fotto_pro') === 'single_large' ? 'block' : 'none' }};">
                <div class="d-flex justify-content-between small fw-bold mb-1">
                  <span>Single Center Watermark Size: <span id="singleLargeSizeLabel" class="text-warning">{{ $setting->single_logo_size ?? 160 }}px</span></span>
                </div>
                <input type="range" class="wm-range-slider" id="singleLargeSizeRange" min="70" max="800" value="{{ $setting->single_logo_size ?? 160 }}" oninput="updateLivePreview()">
                <small class="text-white-50 d-block mt-1">High-impact single brand mark centered in the image.</small>
              </div>

              <!-- PHOTOX PRO GRID CONTROLS (Anti-Crop & Cross-Lines) -->
              <div id="fottoProControls" class="wm-inner-card" style="display: {{ in_array(($setting->watermark_pattern ?? 'fotto_pro'), ['fotto_pro', 'photox_pro']) ? 'block' : 'none' }};">
                <h6 class="fw-bold small text-uppercase text-warning mb-2">Anti-Crop &amp; Geometric Defense</h6>
                <div class="form-check form-switch mb-2">
                  <input class="form-check-input" type="checkbox" id="hasCrossLinesToggle" {{ ($setting->has_cross_lines ?? true) ? 'checked' : '' }} onchange="updateLivePreview()">
                  <label class="form-check-label small fw-semibold text-white" for="hasCrossLinesToggle">Diagonal Cross Lines (Defeats auto-crop bots)</label>
                </div>
                <div class="form-check form-switch mb-2">
                  <input class="form-check-input" type="checkbox" id="hasSecurityBadgeToggle" {{ ($setting->has_security_badge ?? true) ? 'checked' : '' }} onchange="updateLivePreview()">
                  <label class="form-check-label small fw-semibold text-white" for="hasSecurityBadgeToggle">Anti-Screenshot Pill Badge</label>
                </div>
                <div class="mt-2" id="securityBadgeTextContainer">
                  <label class="small text-white-50 mb-1 d-block">Security Badge Text:</label>
                  <input type="text" class="form-control form-control-sm" id="securityBadgeTextInput" value="{{ $setting->security_badge_text ?? 'Do not screenshot' }}" oninput="updateLivePreview()">
                </div>
              </div>

              <!-- Shared Hidden Logo Upload File Input -->
              <input type="file" id="logoFileInput" accept="image/png,image/svg+xml,image/webp" style="display: none;" onchange="handleLogoUpload(event)">

              <!-- SUB-PANEL: TEXT ONLY -->
              <div id="subPanelText" class="wm-inner-card" style="display: {{ ($setting->watermark_type ?? 'both') === 'text' ? 'block' : 'none' }};">
                <div class="mb-3">
                  <label class="fw-bold small text-white-50 d-block mb-1">Watermark Text</label>
                  <input type="text" class="form-control" id="watermarkTextInput" value="{{ $setting->watermark_text ?? $photographer->name }}" maxlength="40" oninput="updateLivePreview()">
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Font size: <span id="textSizeLabel" class="text-warning">{{ $setting->font_size ?? 25 }}px</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="textSizeRange" min="14" max="70" value="{{ $setting->font_size ?? 25 }}" oninput="updateLivePreview()">
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Opacity: <span id="textOpacityLabel" class="text-warning">{{ $setting->opacity ?? 65 }}%</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="textOpacityRange" min="10" max="100" value="{{ $setting->opacity ?? 65 }}" oninput="updateLivePreview()">
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Rotation: <span id="textRotLabel" class="text-warning">{{ $setting->rotation ?? -12 }}°</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="textRotRange" min="-45" max="45" value="{{ $setting->rotation ?? -12 }}" oninput="updateLivePreview()">
                </div>
              </div>

              <!-- SUB-PANEL: LOGO ONLY -->
              <div id="subPanelLogo" class="wm-inner-card" style="display: {{ ($setting->watermark_type ?? 'both') === 'logo' ? 'block' : 'none' }};">
                <div class="mb-3">
                  <label class="fw-bold small text-white-50 d-block mb-2">Photographer Logo</label>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wm-logo-box">
                      <img id="logoThumbPreview" src="{{ asset($setting->logo_path ?? 'uploads/watermarks/swirl_logo.png') }}" alt="Watermark Logo">
                    </div>
                    <div>
                      <button type="button" class="btn btn-sm btn-outline-warning fw-bold rounded-pill px-3" onclick="document.getElementById('logoFileInput').click();">
                        <i class="bi bi-cloud-arrow-up me-1"></i> Upload Logo
                      </button>
                      <small class="text-white-50 d-block mt-1">PNG or SVG with transparent background.</small>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Logo size: <span id="logoSizeLabel" class="text-warning">{{ $setting->logo_size ?? 45 }}px</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="logoSizeRange" min="20" max="120" value="{{ $setting->logo_size ?? 45 }}" oninput="updateLivePreview()">
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Opacity: <span id="logoOpacityLabel" class="text-warning">{{ $setting->opacity ?? 65 }}%</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="logoOpacityRange" min="10" max="100" value="{{ $setting->opacity ?? 65 }}" oninput="updateLivePreview()">
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Rotation: <span id="logoRotLabel" class="text-warning">{{ $setting->rotation ?? 0 }}°</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="logoRotRange" min="-45" max="45" value="{{ $setting->rotation ?? 0 }}" oninput="updateLivePreview()">
                </div>
              </div>

              <!-- SUB-PANEL: BOTH (LOGO + TEXT) -->
              <div id="subPanelBoth" class="wm-inner-card" style="display: {{ ($setting->watermark_type ?? 'both') === 'both' ? 'block' : 'none' }};">
                <div class="mb-3">
                  <label class="fw-bold small text-white-50 d-block mb-1">Brand Signature Text</label>
                  <input type="text" class="form-control" id="bothTextInputVal" value="{{ $setting->watermark_text ?? $photographer->name }}" maxlength="40" oninput="updateLivePreview()">
                </div>
                <div class="mb-3">
                  <label class="fw-bold small text-white-50 d-block mb-2">Photographer Logo</label>
                  <div class="d-flex align-items-center gap-3">
                    <div class="wm-logo-box" style="width: 85px; height: 55px; background: rgba(255,255,255,0.06); border-radius: 8px;">
                      <img id="bothLogoThumbPreview" src="{{ asset($setting->logo_path ?? 'uploads/watermarks/swirl_logo.png') }}" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="Watermark Logo">
                    </div>
                    <div>
                      <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="document.getElementById('logoFileInput').click();">
                        <i class="bi bi-cloud-arrow-up me-1"></i> Upload / Replace Logo
                      </button>
                      <small class="text-white-50 d-block mt-1">PNG, SVG or WebP with transparency.</small>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Logo Size: <span id="bothLogoSizeLabel" class="text-warning">{{ $setting->logo_size ?? 55 }}px</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="bothLogoSizeRange" min="20" max="150" value="{{ $setting->logo_size ?? 55 }}" oninput="updateLivePreview()">
                </div>

                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Text Font Size: <span id="bothFontSizeLabel" class="text-warning">{{ $setting->font_size ?? 25 }}px</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="bothFontSizeRange" min="14" max="60" value="{{ $setting->font_size ?? 25 }}" oninput="updateLivePreview()">
                </div>

                <div class="mb-3">
                  <label class="fw-bold small text-white-50 d-block mb-1">Logo &amp; Text Layout</label>
                  <div class="btn-group w-100" role="group">
                    <button type="button" class="btn btn-sm {{ ($setting->both_layout ?? 'stacked') === 'stacked' ? 'btn-warning text-dark fw-bold' : 'btn-outline-secondary text-white' }}" id="btnLayoutStacked" onclick="setBothLayout('stacked')">
                      <i class="bi bi-distribute-vertical me-1"></i> Stacked (Logo Above Text)
                    </button>
                    <button type="button" class="btn btn-sm {{ ($setting->both_layout ?? 'stacked') === 'inline' ? 'btn-warning text-dark fw-bold' : 'btn-outline-secondary text-white' }}" id="btnLayoutInline" onclick="setBothLayout('inline')">
                      <i class="bi bi-distribute-horizontal me-1"></i> Inline (Side-by-Side)
                    </button>
                  </div>
                </div>

                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Combined Opacity: <span id="bothOpacityLabel" class="text-warning">{{ $setting->opacity ?? 65 }}%</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="bothOpacityRange" min="10" max="100" value="{{ $setting->opacity ?? 65 }}" oninput="updateLivePreview()">
                </div>

                <div class="mb-3">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Rotation: <span id="bothRotLabel" class="text-warning">{{ $setting->rotation ?? -12 }}°</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="bothRotRange" min="-45" max="45" value="{{ $setting->rotation ?? -12 }}" oninput="updateLivePreview()">
                </div>
              </div>

              <div class="pt-3 border-top border-secondary mt-3">
                <button type="button" class="btn-save-settings w-100 justify-content-center" id="saveWatermarkBtn" onclick="saveSettingsToServer()">
                  <i class="bi bi-floppy"></i> Save Pre-Purchase Settings
                </button>
              </div>
            </div>

            <!-- TAB 2: POST-PURCHASE SPONSOR BRANDING (Funded / Sponsored Galleries) -->
            <div id="tabPanelPostPurchase" style="display: none;">
              <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background: #081420; border: 1px solid #192d40;">
                <div>
                  <h4 class="h6 fw-bold mb-1 text-white">Post-Purchase Sponsor Branding</h4>
                  <p class="text-white-50 small mb-0">For sponsored or corporate-funded events. Co-brands high-res downloads.</p>
                </div>
                <label class="wm-switch">
                  <input type="checkbox" id="enablePostPurchaseToggle" {{ ($setting->is_post_purchase_enabled ?? true) ? 'checked' : '' }} onchange="onPostPurchaseToggleChange()">
                  <span class="wm-slider"></span>
                </label>
              </div>

              <!-- Delivery Mode -->
              <div class="wm-inner-card">
                <label class="fw-bold small text-uppercase text-white-50 d-block mb-2">Purchased Download Delivery Policy</label>
                <div class="d-flex gap-2 mb-2">
                  <button type="button" class="btn btn-sm flex-fill {{ ($setting->post_purchase_mode ?? 'clean') === 'clean' ? 'btn-warning fw-bold text-dark active' : 'btn-outline-secondary' }}" id="btnPostModeClean" onclick="setPostPurchaseMode('clean')">
                    <i class="bi bi-check2-circle me-1"></i> 100% Clean Image
                  </button>
                  <button type="button" class="btn btn-sm flex-fill {{ ($setting->post_purchase_mode ?? 'clean') === 'sponsor_branded' ? 'btn-warning fw-bold text-dark active' : 'btn-outline-secondary' }}" id="btnPostModeSponsor" onclick="setPostPurchaseMode('sponsor_branded')">
                    <i class="bi bi-award me-1"></i> Sponsored Gallery Branding
                  </button>
                </div>
                <small class="text-white-50 d-block">
                  Clean Mode delivers raw clean photos without marks. Sponsored Mode stamps the sponsor/event partner logo onto downloaded files.
                </small>
              </div>

              <div id="sponsorBrandingControls" style="display: {{ ($setting->post_purchase_mode ?? 'clean') === 'sponsor_branded' ? 'block' : 'none' }};">
                <!-- Sponsor Logo Upload -->
                <div class="wm-inner-card">
                  <label class="fw-bold small text-white-50 d-block mb-2">Sponsor / Event Partner Logo</label>
                  <div class="d-flex align-items-center gap-3">
                    <div class="bg-black p-2 rounded-2 border border-secondary" style="width: 140px; height: 50px; display: flex; align-items: center; justify-content: center;">
                      <img id="sponsorThumbPreview" src="{{ asset($setting->sponsor_logo_path ?? 'uploads/watermarks/sample_sponsor_badge.svg') }}" style="max-height: 38px; max-width: 120px;" alt="Sponsor Logo">
                    </div>
                    <div>
                      <button type="button" class="btn btn-sm btn-outline-warning fw-bold rounded-pill px-3" onclick="document.getElementById('sponsorFileInput').click();">
                        <i class="bi bi-cloud-arrow-up me-1"></i> Upload Logo
                      </button>
                      <input type="file" id="sponsorFileInput" accept="image/png,image/svg+xml,image/webp,image/jpeg" style="display: none;" onchange="handleSponsorUpload(event)">
                      <small class="text-white-50 d-block mt-1">PNG or SVG with transparency.</small>
                    </div>
                  </div>
                </div>

                <!-- Placement Selection: Corners or Middle Bottom -->
                <div class="wm-inner-card">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="fw-bold small text-uppercase text-white-50 mb-0">Sponsor Logo Placement on Photo</label>
                    <span class="badge bg-warning text-dark font-monospace" id="activeSponsorPlacementBadge">{{ strtoupper(str_replace('_', ' ', $setting->sponsor_placement ?? 'bottom_right')) }}</span>
                  </div>
                  <div class="row g-2 mb-2">
                    <div class="col-6">
                      <button type="button" class="btn btn-sm w-100 sponsor-pos-btn {{ ($setting->sponsor_placement ?? 'bottom_right') === 'bottom_right' ? 'active btn-warning text-dark fw-bold' : 'btn-outline-secondary' }}" id="posBottomRightBtn" onclick="setSponsorPlacement('bottom_right')">
                        <i class="bi bi-arrow-down-right me-1"></i> Bottom-Right (Corner)
                      </button>
                    </div>
                    <div class="col-6">
                      <button type="button" class="btn btn-sm w-100 sponsor-pos-btn {{ ($setting->sponsor_placement ?? 'bottom_right') === 'bottom_left' ? 'active btn-warning text-dark fw-bold' : 'btn-outline-secondary' }}" id="posBottomLeftBtn" onclick="setSponsorPlacement('bottom_left')">
                        <i class="bi bi-arrow-down-left me-1"></i> Bottom-Left (Corner)
                      </button>
                    </div>
                    <div class="col-6">
                      <button type="button" class="btn btn-sm w-100 sponsor-pos-btn {{ ($setting->sponsor_placement ?? 'bottom_right') === 'top_right' ? 'active btn-warning text-dark fw-bold' : 'btn-outline-secondary' }}" id="posTopRightBtn" onclick="setSponsorPlacement('top_right')">
                        <i class="bi bi-arrow-up-right me-1"></i> Top-Right (Corner)
                      </button>
                    </div>
                    <div class="col-6">
                      <button type="button" class="btn btn-sm w-100 sponsor-pos-btn {{ ($setting->sponsor_placement ?? 'bottom_right') === 'top_left' ? 'active btn-warning text-dark fw-bold' : 'btn-outline-secondary' }}" id="posTopLeftBtn" onclick="setSponsorPlacement('top_left')">
                        <i class="bi bi-arrow-up-left me-1"></i> Top-Left (Corner)
                      </button>
                    </div>
                    <div class="col-12">
                      <button type="button" class="btn btn-sm w-100 sponsor-pos-btn {{ ($setting->sponsor_placement ?? 'bottom_right') === 'middle_bottom' ? 'active btn-warning text-dark fw-bold' : 'btn-outline-secondary' }}" id="posMiddleBottomBtn" onclick="setSponsorPlacement('middle_bottom')">
                        <i class="bi bi-align-center me-1"></i> Middle Bottom (Center-Bottom Sponsor Ribbon)
                      </button>
                    </div>
                  </div>
                  <small class="text-white-50">Exact corner &amp; middle-bottom placement for sports event sponsors.</small>
                </div>

                <!-- Sponsor Size Slider -->
                <div class="wm-inner-card">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Sponsor Logo Size: <span id="sponsorSizeLabel" class="text-warning">{{ $setting->sponsor_logo_size ?? 70 }}px</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="sponsorSizeRange" min="30" max="150" value="{{ $setting->sponsor_logo_size ?? 70 }}" oninput="updateLivePreview()">
                </div>

                <!-- Sponsor Opacity Slider -->
                <div class="wm-inner-card">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Sponsor Logo Opacity: <span id="sponsorOpacityLabel" class="text-warning">{{ $setting->sponsor_opacity ?? 90 }}%</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="sponsorOpacityRange" min="30" max="100" value="{{ $setting->sponsor_opacity ?? 90 }}" oninput="updateLivePreview()">
                </div>

                <!-- Margin Slider -->
                <div class="wm-inner-card">
                  <div class="d-flex justify-content-between small fw-bold mb-1">
                    <span>Margin from Edge: <span id="sponsorMarginLabel" class="text-warning">{{ $setting->sponsor_margin ?? 0 }}px</span></span>
                  </div>
                  <input type="range" class="wm-range-slider" id="sponsorMarginRange" min="0" max="40" value="{{ $setting->sponsor_margin ?? 0 }}" oninput="updateLivePreview()">
                  <small class="text-white-50 d-block mt-1">Set to 0px for edge-to-edge flush ribbons.</small>
                </div>
              </div>

              <div class="pt-3 border-top border-secondary mt-3">
                <button type="button" class="btn-save-settings w-100 justify-content-center" onclick="saveSettingsToServer()">
                  <i class="bi bi-floppy"></i> Save Post-Purchase Settings
                </button>
              </div>
            </div>

            <!-- TAB 3: DOWNLOAD PROTECTION -->
            <div id="tabPanelDownload" style="display: none;">
              <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background: #081420; border: 1px solid #192d40;">
                <div>
                  <h4 class="h6 fw-bold mb-1 text-white">Download Protection Defense</h4>
                  <p class="text-white-50 small mb-0">Stops visitors from saving gallery photos without purchasing.</p>
                </div>
                <label class="wm-switch">
                  <input type="checkbox" id="enableDownloadProtectionToggle" {{ ($setting->is_download_protection_enabled ?? true) ? 'checked' : '' }} onchange="onDownloadToggleChange()">
                  <span class="wm-slider"></span>
                </label>
              </div>

              <div class="wm-inner-card mb-4">
                <h6 class="fw-bold mb-2 small text-uppercase text-warning">Anti-Theft Mechanics</h6>
                <ul class="text-white-50 small ps-3 mb-0">
                  <li class="mb-2"><strong>Right-Click &amp; Drag Blocked:</strong> Visitors cannot right-click "Save Image As".</li>
                  <li class="mb-2"><strong>Mosaic Sliced Canvas:</strong> Divides image into transparent slices to defeat automated scrapers.</li>
                  <li><strong>DevTools Interceptor:</strong> Invisible overlay absorbs element inspection and screenshot keys.</li>
                </ul>
              </div>

              <div class="pt-3 border-top border-secondary">
                <button type="button" class="btn-save-settings w-100 justify-content-center" onclick="saveSettingsToServer()">
                  <i class="bi bi-floppy"></i> Save Download Protection
                </button>
              </div>
            </div>

            <!-- TAB 4: WATERMOTION & LIQUID GLASS LENS -->
            <div id="tabPanelMotion" style="display: none;">
              <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3" style="background: #081420; border: 1px solid #192d40;">
                <div>
                  <h4 class="h6 fw-bold mb-1 text-white">WaterMotion &amp; Liquid Glass Lens</h4>
                  <p class="text-white-50 small mb-0">Organic fluid caustics and drifting refractive water droplets prevent AI photo recreation.</p>
                </div>
                <label class="wm-switch">
                  <input type="checkbox" id="enableMotionMaskToggle" {{ ($setting->is_motion_mask_enabled ?? false) ? 'checked' : '' }} onchange="onMotionToggleChange()">
                  <span class="wm-slider"></span>
                </label>
              </div>

              <!-- WaterMotion Mode Selector -->
              <div class="wm-inner-card">
                <label class="fw-bold small text-uppercase text-info d-block mb-2">
                  <i class="bi bi-droplet-half me-1"></i> WaterMotion Style &amp; Optics
                </label>
                <div class="row g-2 mb-2">
                  <div class="col-6">
                    <button type="button" class="btn btn-sm w-100 text-truncate btn-warning fw-bold text-dark" id="motionPresetDropBtn" onclick="setWaterMotionPreset('crystal_drop')">
                      <i class="bi bi-droplet-fill me-1"></i> Crystal Droplet
                    </button>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-sm w-100 text-truncate btn-outline-secondary fw-semibold" id="motionPresetDualBtn" onclick="setWaterMotionPreset('dual_lenses')">
                      <i class="bi bi-circles me-1"></i> Dual Floating Lenses
                    </button>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-sm w-100 text-truncate btn-outline-secondary fw-semibold" id="motionPresetRippleBtn" onclick="setWaterMotionPreset('fluid_ripple')">
                      <i class="bi bi-water me-1"></i> Concentric Ripples
                    </button>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-sm w-100 text-truncate btn-outline-secondary fw-semibold" id="motionPresetFollowBtn" onclick="setWaterMotionPreset('cursor_follow')">
                      <i class="bi bi-cursor-fill me-1"></i> Mouse Interactive
                    </button>
                  </div>
                </div>
                <small class="text-white-50 d-block" id="motionPresetDescText">
                  High-clarity spherical liquid glass droplet with caustic light glints and optical refraction.
                </small>
              </div>

              <!-- Water Lens Size Slider -->
              <div class="wm-inner-card">
                <div class="d-flex justify-content-between small fw-bold mb-1">
                  <span>Water Lens Diameter:</span>
                  <span id="waterLensSizeLabel" class="text-warning">190px</span>
                </div>
                <input type="range" class="wm-range-slider" id="waterLensSizeRange" min="100" max="320" value="190" oninput="onWaterLensControlChange()">
                <small class="text-white-50 d-block mt-1">Adjusts the scale of the spherical refracting water lens.</small>
              </div>

              <!-- Flow Speed Slider -->
              <div class="wm-inner-card">
                <div class="d-flex justify-content-between small fw-bold mb-1">
                  <span>Fluid Drift Speed:</span>
                  <span id="waterLensSpeedLabel" class="text-warning">Balanced (10s)</span>
                </div>
                <input type="range" class="wm-range-slider" id="waterLensSpeedRange" min="4" max="20" value="10" oninput="onWaterLensControlChange()">
                <small class="text-white-50 d-block mt-1">Controls the organic floating velocity across the sports photo canvas.</small>
              </div>

              <!-- Optical Refraction Intensity -->
              <div class="wm-inner-card">
                <div class="d-flex justify-content-between small fw-bold mb-1">
                  <span>Glass Refraction &amp; Blur:</span>
                  <span id="waterLensBlurLabel" class="text-warning">1.5px (Crystal Clear)</span>
                </div>
                <input type="range" class="wm-range-slider" id="waterLensBlurRange" min="0" max="5" step="0.5" value="1.5" oninput="onWaterLensControlChange()">
                <small class="text-white-50 d-block mt-1">Simulates light refraction passing through spherical water.</small>
              </div>

              <!-- Informational Note -->
              <div class="p-3 rounded-3 border mb-4" style="background: rgba(6, 182, 212, 0.1); border-color: rgba(6, 182, 212, 0.3) !important;">
                <div class="d-flex align-items-center gap-2 text-info fw-bold mb-1">
                  <i class="bi bi-shield-check"></i> Zero Ugly Black Rings
                </div>
                <p class="text-white-50 small mb-0" style="font-size: 0.78rem;">
                  WaterMotion uses pure optical caustics, dual curved specular reflections, and seamless backdrop distortion. Screenshots are optically corrupted while legitimate buyers receive 100% clean photos.
                </p>
              </div>

              <div class="pt-3 border-top border-secondary">
                <button type="button" class="btn-save-settings w-100 justify-content-center" onclick="saveSettingsToServer()">
                  <i class="bi bi-floppy"></i> Save WaterMotion Settings
                </button>
              </div>
            </div>
          </div>

          <!-- ============================================== -->
          <!-- RIGHT COLUMN: LIVE RESPONSIVE PREVIEW          -->
          <!-- ============================================== -->
          <div class="col-lg-7 order-1 order-lg-2">
            <!-- PREVIEW MODE SELECTOR BAR (Pre-Purchase vs Post-Purchase) -->
            <div class="preview-mode-bar d-flex flex-wrap justify-content-between align-items-center p-2 rounded-3 mb-2 gap-2" style="background: #081420; border: 1px solid #1f374e;">
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="small fw-bold text-white-50 text-uppercase me-1"><i class="bi bi-eye text-warning me-1"></i> Preview Stage:</span>
                <div class="btn-group btn-group-sm" role="group">
                  <button type="button" class="btn btn-warning fw-bold text-dark" id="btnPreviewPrePurchase" onclick="setPreviewStageMode('pre')">
                    <i class="bi bi-shield-lock me-1"></i> Pre-Purchase (Watermarked)
                  </button>
                  <button type="button" class="btn btn-outline-secondary fw-semibold" id="btnPreviewPostPurchase" onclick="setPreviewStageMode('post')">
                    <i class="bi bi-award me-1"></i> Post-Purchase (Downloaded)
                  </button>
                </div>
              </div>
              <div class="badge bg-dark text-warning border border-warning px-2 py-1 small preview-mode-badge" id="previewModeBadge">
                Album Preview (Protected)
              </div>
            </div>

            <!-- Stage Actions & Sports Photo Switcher -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
              <h4 class="h6 fw-bold mb-0 text-white"><i class="bi bi-camera-fill text-warning me-1"></i> Live Studio Canvas</h4>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-warning rounded-pill active" id="btnPhotoLandscape" onclick="switchPreviewPhoto('landscape')">
                  <i class="bi bi-image me-1"></i> Landscape
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" id="btnPhotoPortrait" onclick="switchPreviewPhoto('portrait')">
                  <i class="bi bi-phone me-1"></i> Portrait
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" id="btnPhotoCustom" onclick="document.getElementById('testPhotoInput').click()">
                  <i class="bi bi-cloud-upload me-1"></i> Custom
                </button>
                <input type="file" id="testPhotoInput" accept="image/*" style="display: none;" onchange="handleTestPhotoUpload(event)">
              </div>
            </div>

            <!-- Stage Wrapper -->
            <div class="wm-preview-wrapper" id="previewStage">
              <!-- Base Photo -->
              <img id="previewBasePhoto" class="base-photo" src="{{ asset('uploads/watermarks/photox_dummy_marathon.jpg') }}" alt="PhotoX Sports Photo">

              <!-- Anti-AI Diagonal Cross-Hatch Security Grid Wires -->
              <svg class="wm-anti-ai-lines-svg" id="antiAiLinesSvg" xmlns="http://www.w3.org/2000/svg">
                <defs>
                  <pattern id="antiAiPattern" width="90" height="90" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                    <line x1="0" y1="0" x2="0" y2="90" stroke="rgba(255,138,0,0.5)" stroke-width="1.2" stroke-dasharray="10 6" id="antiAiLine1" />
                    <line x1="45" y1="0" x2="45" y2="90" stroke="rgba(255,255,255,0.3)" stroke-width="0.8" id="antiAiLine2" />
                  </pattern>
                  <pattern id="antiAiCrossPattern" width="110" height="110" patternUnits="userSpaceOnUse" patternTransform="rotate(-45)">
                    <line x1="0" y1="0" x2="0" y2="110" stroke="rgba(255,138,0,0.4)" stroke-width="1" stroke-dasharray="12 8" id="antiAiLine3" />
                  </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#antiAiPattern)" />
                <rect width="100%" height="100%" fill="url(#antiAiCrossPattern)" />
              </svg>

              <!-- 1. Watermark Standard Overlay Grid (for Tiled Grid) -->
              <div class="wm-watermark-overlay" id="watermarkGridOverlay"></div>

              <!-- 2. SINGLE LARGE CENTER WATERMARK (Prominent brand mark) -->
              <div class="wm-single-large-box" id="singleLargeWatermarkBox">
                <div id="singleLargeContent"></div>
              </div>

              <!-- 3. PHOTOX PRO STYLE OVERLAY -->
              <div class="wm-fotto-pro-layer" id="fottoProOverlay">
                <!-- Diagonal Geometric Cross Lines -->
                <svg class="wm-diagonal-cross-svg" id="fottoCrossLinesSvg" xmlns="http://www.w3.org/2000/svg">
                  <line x1="0" y1="0" x2="100%" y2="100%" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" stroke-dasharray="6 6" />
                  <line x1="100%" y1="0" x2="0" y2="100%" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" stroke-dasharray="6 6" />
                </svg>

                <!-- Corner Repetitions -->
                <div class="wm-corner-mark wm-corner-tl" id="fottoCornerTL">{{ $setting->watermark_text ?? $photographer->name }}</div>
                <div class="wm-corner-mark wm-corner-tr" id="fottoCornerTR">{{ $setting->watermark_text ?? $photographer->name }}</div>
                <div class="wm-corner-mark wm-corner-bl" id="fottoCornerBL">{{ $setting->watermark_text ?? $photographer->name }}</div>
                <div class="wm-corner-mark wm-corner-br" id="fottoCornerBR">{{ $setting->watermark_text ?? $photographer->name }}</div>

                <!-- Vertical Side Ribbon -->
                <div class="wm-fotto-vertical-ribbon" id="fottoVerticalRibbon">PHOTOX PROTECTED</div>

                <!-- Big Central Brand Watermark -->
                <div class="wm-fotto-center-box" id="fottoCenterBox">
                  <div id="fottoCenterContent" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                    <img id="fottoCenterLogo" src="{{ asset($setting->logo_path ?? 'uploads/watermarks/swirl_logo.png') }}" style="max-height: 55px; width: auto; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.7)); display: none;" alt="Watermark Logo">
                    <div class="wm-fotto-center-title" id="fottoCenterTitle">{{ $setting->watermark_text ?? $photographer->name }}</div>
                  </div>
                </div>

                <!-- Security Anti-Screenshot Badge -->
                <div class="wm-fotto-security-badge" id="fottoSecurityBadge">
                  <i class="bi bi-slash-circle me-1"></i> <span id="fottoSecurityBadgeText">{{ $setting->security_badge_text ?? 'Do not screenshot' }}</span>
                </div>
              </div>

              <!-- 3b. DOUBLE X-CROSS SHIELD OVERLAY -->
              <div class="wm-double-cross-layer" id="doubleCrossOverlay">
                <svg class="wm-diagonal-cross-svg" id="doubleCrossSvg" xmlns="http://www.w3.org/2000/svg">
                  <line x1="0" y1="0" x2="100%" y2="100%" stroke="rgba(255,138,0,0.5)" stroke-width="2" stroke-dasharray="8 6" />
                  <line x1="100%" y1="0" x2="0" y2="100%" stroke="rgba(255,138,0,0.5)" stroke-width="2" stroke-dasharray="8 6" />
                  <circle cx="50%" cy="50%" r="90" stroke="rgba(255,138,0,0.5)" stroke-width="2" fill="none" stroke-dasharray="6 4" />
                </svg>
                <div class="wm-double-cross-center" id="doubleCrossCenterBox">
                  <img id="doubleCrossLogo" src="{{ asset($setting->logo_path ?? 'uploads/watermarks/swirl_logo.png') }}" style="max-height: 48px; width: auto; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.7)); display: none;" alt="Watermark Logo">
                  <div class="fw-bold font-monospace text-uppercase" id="doubleCrossTitle" style="color: #ff8a00; font-size: 26px; letter-spacing: 0.1em; text-shadow: 0 2px 10px rgba(0,0,0,0.9);">{{ $setting->watermark_text ?? $photographer->name }}</div>
                  <small class="badge bg-dark border border-warning text-warning mt-1" style="font-size: 9px; letter-spacing: 0.15em;">OFFICIAL PROOF</small>
                </div>
              </div>

              <!-- 3c. HEX MESH OVERLAY -->
              <div class="wm-hex-mesh-layer" id="hexMeshOverlay">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" style="position: absolute; inset: 0;" id="hexMeshSvg">
                  <defs>
                    <pattern id="hexPattern" width="100" height="86" patternUnits="userSpaceOnUse">
                      <path d="M50 0 L100 28.8 L100 86.6 L50 57.7 L0 86.6 L0 28.8 Z" fill="none" stroke="rgba(255,138,0,0.25)" stroke-width="1.2" id="hexPatternPath" />
                    </pattern>
                  </defs>
                  <rect width="100%" height="100%" fill="url(#hexPattern)" />
                </svg>
                <div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%) rotate(-12deg); text-align: center;" id="hexMeshCenterBox">
                  <img id="hexMeshLogo" src="{{ asset($setting->logo_path ?? 'uploads/watermarks/swirl_logo.png') }}" style="max-height: 52px; width: auto; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.7)); display: none;" alt="Logo">
                  <div class="fw-bold font-monospace text-uppercase" id="hexMeshTitle" style="color: #ff8a00; font-size: 32px; letter-spacing: 0.08em; text-shadow: 0 3px 12px rgba(0,0,0,0.9);">{{ $setting->watermark_text ?? $photographer->name }}</div>
                </div>
              </div>

              <!-- 3d. QUAD CORNERS ANTI-CROP OVERLAY -->
              <div class="wm-quad-corners-layer" id="quadCornersOverlay">
                <div class="wm-bracket wm-bracket-tl" id="quadBracketTL"></div>
                <div class="wm-bracket wm-bracket-tr" id="quadBracketTR"></div>
                <div class="wm-bracket wm-bracket-bl" id="quadBracketBL"></div>
                <div class="wm-bracket wm-bracket-br" id="quadBracketBR"></div>
                <div style="position: absolute; top: 22px; left: 26px; font-size: 11px; font-weight: 700; color: #ff8a00; letter-spacing: 0.1em;" id="quadCornerTextTL">PHOTOX PROOF</div>
                <div style="position: absolute; bottom: 22px; right: 26px; font-size: 11px; font-weight: 700; color: #ff8a00; letter-spacing: 0.1em;" id="quadCornerTextBR">DO NOT COPY</div>
                <div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); text-align: center;" id="quadCenterBox">
                  <img id="quadCenterLogo" src="{{ asset($setting->logo_path ?? 'uploads/watermarks/swirl_logo.png') }}" style="max-height: 50px; width: auto; filter: drop-shadow(0 2px 8px rgba(0,0,0,0.7)); display: none;" alt="Logo">
                  <div class="fw-bold font-monospace text-uppercase" id="quadCenterTitle" style="color: #ff8a00; font-size: 30px; letter-spacing: 0.08em; text-shadow: 0 3px 12px rgba(0,0,0,0.9);">{{ $setting->watermark_text ?? $photographer->name }}</div>
                </div>
              </div>

              <!-- 4. POST-PURCHASE SPONSOR BRANDING LAYER (Active on downloaded photo) -->
              <div class="wm-sponsor-layer" id="sponsorOverlay">
                <div class="wm-sponsor-badge-box placement-bottom_right" id="sponsorBadgeBox">
                  <img id="sponsorBadgeImg" src="{{ asset($setting->sponsor_logo_path ?? 'uploads/watermarks/sample_sponsor_badge.svg') }}" alt="Sponsor Logo">
                </div>
              </div>

              <!-- 5. Download Protection Mosaic Grid -->
              <div class="wm-download-protection-layer" id="downloadProtectionGrid">
                @for($i = 0; $i < 24; $i++)
                  <div class="wm-protection-tile"></div>
                @endfor
              </div>

              <!-- 6. WaterMotion Liquid Glass Lenses & Fluid Waves -->
              <div class="wm-motion-mask-layer" id="motionMaskLenses">
                <!-- Primary Crystal Liquid Water Lens -->
                <div class="wm-water-lens wm-water-lens-primary" id="waterLens1">
                  <div class="wm-lens-inner-glass"></div>
                  <div class="wm-lens-glint wm-lens-glint-top"></div>
                  <div class="wm-lens-glint wm-lens-glint-bottom"></div>
                  <div class="wm-lens-ring"></div>
                </div>

                <!-- Secondary Ambient Water Lens -->
                <div class="wm-water-lens wm-water-lens-secondary" id="waterLens2">
                  <div class="wm-lens-inner-glass"></div>
                  <div class="wm-lens-glint wm-lens-glint-top"></div>
                  <div class="wm-lens-ring"></div>
                </div>

                <!-- Fluid Concentric Ripple Rings (Active in Ripple Mode) -->
                <div class="wm-water-ripple-layer" id="waterRippleLayer" style="display: none;">
                  <div class="wm-ripple-ring ring-1"></div>
                  <div class="wm-ripple-ring ring-2"></div>
                  <div class="wm-ripple-ring ring-3"></div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-2 px-1">
              <small class="text-white-50" id="stageFooterStatusText"><i class="bi bi-shield-check text-warning me-1"></i> Pre-Purchase Protection Active</small>
              <small class="text-white-50 font-monospace" id="stageFooterDimensionsText">1920 &times; 1200 HD</small>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Save Toast Notification -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="saveToast" class="toast align-items-center text-bg-dark border border-warning shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body" id="toastMessage">
          <i class="bi bi-check-circle-fill text-warning me-2"></i> Settings saved successfully!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script>
    let currentTab = 'watermark';
    let currentPreviewStageMode = 'pre'; // 'pre' (Pre-Purchase) or 'post' (Post-Purchase)
    let watermarkType = "{{ $setting->watermark_type ?? 'both' }}";
    let watermarkPattern = "{{ $setting->watermark_pattern ?? 'fotto_pro' }}";
    let watermarkDensity = "{{ $setting->watermark_density ?? 'high' }}";
    let bothLayout = "{{ $setting->both_layout ?? 'stacked' }}";
    let postPurchaseMode = "{{ $setting->post_purchase_mode ?? 'clean' }}";
    let sponsorPlacement = "{{ $setting->sponsor_placement ?? 'bottom_right' }}";

    function setBothLayout(layout) {
      bothLayout = layout;
      const btnStacked = document.getElementById('btnLayoutStacked');
      const btnInline = document.getElementById('btnLayoutInline');
      if (btnStacked) btnStacked.className = (layout === 'stacked') ? 'btn btn-sm btn-warning text-dark fw-bold' : 'btn btn-sm btn-outline-secondary text-white';
      if (btnInline) btnInline.className = (layout === 'inline') ? 'btn btn-sm btn-warning text-dark fw-bold' : 'btn btn-sm btn-outline-secondary text-white';
      updateLivePreview();
    }

    function setWatermarkDensity(density) {
      watermarkDensity = density;
      const btnMed = document.getElementById('densityMediumBtn');
      const btnHigh = document.getElementById('densityHighBtn');
      const btnUltra = document.getElementById('densityUltraBtn');
      if (btnMed) btnMed.classList.toggle('active', density === 'medium');
      if (btnHigh) btnHigh.classList.toggle('active', density === 'high');
      if (btnUltra) btnUltra.classList.toggle('active', density === 'ultra');
      updateLivePreview();
    }
    
    let rawColor = "{{ $setting->watermark_color ?? '#ff8a00' }}";
    let watermarkColor = '#ff8a00';
    if (rawColor === 'white') watermarkColor = '#ffffff';
    else if (rawColor === 'monochrome') watermarkColor = '#1e293b';
    else if (rawColor && rawColor !== 'orange') watermarkColor = rawColor.startsWith('#') ? rawColor : ('#' + rawColor);
    
    let logoUrl = "{{ asset($setting->logo_path ?? 'uploads/watermarks/swirl_logo.png') }}";
    let uploadedLogoFile = null;

    let sponsorLogoUrl = "{{ asset($setting->sponsor_logo_path ?? 'uploads/watermarks/sample_sponsor_badge.svg') }}";
    let uploadedSponsorFile = null;

    const landscapePhotoUrl = "{{ asset('uploads/watermarks/photox_dummy_marathon.jpg') }}";
    const portraitPhotoUrl = "https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=800&h=1067&q=88";

    function switchMainTab(tab) {
      currentTab = tab;
      document.querySelectorAll('.wm-top-tab').forEach(b => b.classList.remove('active'));
      document.getElementById('tabPanelWatermark').style.display = 'none';
      document.getElementById('tabPanelPostPurchase').style.display = 'none';
      document.getElementById('tabPanelDownload').style.display = 'none';
      document.getElementById('tabPanelMotion').style.display = 'none';

      if (tab === 'watermark') {
        document.getElementById('tabWatermarkBtn').classList.add('active');
        document.getElementById('tabPanelWatermark').style.display = 'block';
        setPreviewStageMode('pre');
      } else if (tab === 'post_purchase') {
        document.getElementById('tabPostPurchaseBtn').classList.add('active');
        document.getElementById('tabPanelPostPurchase').style.display = 'block';
        setPreviewStageMode('post');
      } else if (tab === 'download') {
        document.getElementById('tabDownloadBtn').classList.add('active');
        document.getElementById('tabPanelDownload').style.display = 'block';
        setPreviewStageMode('pre');
      } else if (tab === 'motion') {
        document.getElementById('tabMotionBtn').classList.add('active');
        document.getElementById('tabPanelMotion').style.display = 'block';
        setPreviewStageMode('pre');
      }
      updateLivePreview();
    }

    function setPreviewStageMode(mode) {
      currentPreviewStageMode = mode;
      const btnPre = document.getElementById('btnPreviewPrePurchase');
      const btnPost = document.getElementById('btnPreviewPostPurchase');
      const badge = document.getElementById('previewModeBadge');
      const footerText = document.getElementById('stageFooterStatusText');

      if (mode === 'pre') {
        btnPre.className = 'btn btn-warning fw-bold text-dark';
        btnPost.className = 'btn btn-outline-secondary fw-semibold';
        badge.textContent = 'Album Preview (Protected)';
        badge.className = 'badge bg-dark text-warning border border-warning px-2 py-1 small';
        footerText.innerHTML = '<i class="bi bi-shield-check text-warning me-1"></i> Pre-Purchase Protection Active';
      } else {
        btnPre.className = 'btn btn-outline-secondary fw-semibold';
        btnPost.className = 'btn btn-warning fw-bold text-dark';
        badge.textContent = 'Post-Purchase Download (Sponsor Branded)';
        badge.className = 'badge bg-success text-white px-2 py-1 small';
        footerText.innerHTML = '<i class="bi bi-award-fill text-success me-1"></i> Post-Purchase Clean Download with Sponsor Co-Branding';
      }
      updateLivePreview();
    }

    function onWatermarkToggleChange() {
      const enabled = document.getElementById('enableWatermarkToggle').checked;
      document.getElementById('tabWatermarkStatusBadge').textContent = enabled ? 'ON' : 'OFF';
      updateLivePreview();
    }

    function onPostPurchaseToggleChange() {
      const enabled = document.getElementById('enablePostPurchaseToggle').checked;
      document.getElementById('tabPostPurchaseStatusBadge').textContent = enabled ? 'ON' : 'OFF';
      updateLivePreview();
    }

    function onDownloadToggleChange() {
      const enabled = document.getElementById('enableDownloadProtectionToggle').checked;
      document.getElementById('tabDownloadStatusBadge').textContent = enabled ? 'ON' : 'OFF';
      updateLivePreview();
    }

    function onMotionToggleChange() {
      const enabled = document.getElementById('enableMotionMaskToggle').checked;
      document.getElementById('tabMotionStatusBadge').textContent = enabled ? 'ON' : 'OFF';
      updateLivePreview();
    }

    let waterMotionPreset = 'crystal_drop';

    function setWaterMotionPreset(preset) {
      waterMotionPreset = preset;
      const presetButtons = {
        'crystal_drop': 'motionPresetDropBtn',
        'dual_lenses': 'motionPresetDualBtn',
        'fluid_ripple': 'motionPresetRippleBtn',
        'cursor_follow': 'motionPresetFollowBtn'
      };

      Object.keys(presetButtons).forEach(key => {
        const btn = document.getElementById(presetButtons[key]);
        if (btn) {
          btn.className = (preset === key)
            ? 'btn btn-sm w-100 text-truncate btn-warning fw-bold text-dark'
            : 'btn btn-sm w-100 text-truncate btn-outline-secondary fw-semibold';
        }
      });

      const desc = document.getElementById('motionPresetDescText');
      if (desc) {
        if (preset === 'crystal_drop') {
          desc.textContent = 'High-clarity spherical liquid glass droplet with caustic light glints and optical refraction.';
        } else if (preset === 'dual_lenses') {
          desc.textContent = 'Dual drifting liquid lenses floating synchronously for multi-focal protection across the image.';
        } else if (preset === 'fluid_ripple') {
          desc.textContent = 'Concentric fluid shockwaves radiating outward from the water droplet, distorting screenshots.';
        } else if (preset === 'cursor_follow') {
          desc.textContent = 'Interactive lens that dynamically follows the user cursor with real-time liquid magnification.';
        }
      }

      const lens1 = document.getElementById('waterLens1');
      if (lens1 && preset !== 'cursor_follow') {
        lens1.style.animation = '';
        lens1.style.left = '';
        lens1.style.top = '';
        lens1.style.transform = '';
      }

      updateWaterMotionElements();
    }

    function onWaterLensControlChange() {
      const size = document.getElementById('waterLensSizeRange') ? document.getElementById('waterLensSizeRange').value : 190;
      const speed = document.getElementById('waterLensSpeedRange') ? document.getElementById('waterLensSpeedRange').value : 10;
      const blur = document.getElementById('waterLensBlurRange') ? document.getElementById('waterLensBlurRange').value : 1.5;

      const sizeLabel = document.getElementById('waterLensSizeLabel');
      const speedLabel = document.getElementById('waterLensSpeedLabel');
      const blurLabel = document.getElementById('waterLensBlurLabel');

      if (sizeLabel) sizeLabel.textContent = size + 'px';
      if (speedLabel) speedLabel.textContent = speed <= 6 ? `Fast (${speed}s)` : (speed >= 15 ? `Gentle (${speed}s)` : `Balanced (${speed}s)`);
      if (blurLabel) blurLabel.textContent = blur == 0 ? '0px (Pure Glass)' : `${blur}px (${blur <= 2 ? 'Crystal Clear' : 'Frosted'})`;

      const mask = document.getElementById('motionMaskLenses');
      if (mask) {
        mask.style.setProperty('--water-lens-size', size + 'px');
        mask.style.setProperty('--water-motion-speed', speed + 's');
        mask.style.setProperty('--water-lens-blur', blur + 'px');
      }
    }

    function updateWaterMotionElements() {
      const isMotionMaskEnabled = document.getElementById('enableMotionMaskToggle') ? document.getElementById('enableMotionMaskToggle').checked : false;
      const mask = document.getElementById('motionMaskLenses');
      const lens1 = document.getElementById('waterLens1');
      const lens2 = document.getElementById('waterLens2');
      const rippleLayer = document.getElementById('waterRippleLayer');

      if (!mask) return;

      if (!isMotionMaskEnabled || currentPreviewStageMode === 'post') {
        mask.classList.remove('active');
        return;
      }

      mask.classList.add('active');

      if (lens1) lens1.style.display = 'block';

      if (waterMotionPreset === 'crystal_drop') {
        if (lens2) lens2.style.display = 'none';
        if (rippleLayer) rippleLayer.style.display = 'none';
      } else if (waterMotionPreset === 'dual_lenses') {
        if (lens2) lens2.style.display = 'block';
        if (rippleLayer) rippleLayer.style.display = 'none';
      } else if (waterMotionPreset === 'fluid_ripple') {
        if (lens2) lens2.style.display = 'none';
        if (rippleLayer) rippleLayer.style.display = 'block';
      } else if (waterMotionPreset === 'cursor_follow') {
        if (lens2) lens2.style.display = 'none';
        if (rippleLayer) rippleLayer.style.display = 'none';
        if (lens1) lens1.style.animation = 'none';
      }
    }

    function setWatermarkPattern(pattern) {
      watermarkPattern = pattern;
      
      const patternButtons = {
        'fotto_pro': 'patternFottoProBtn',
        'tiled': 'patternTiledBtn',
        'single_large': 'patternSingleLargeBtn',
        'double_cross': 'patternDoubleCrossBtn',
        'hex_mesh': 'patternHexMeshBtn',
        'quad_corners': 'patternQuadCornersBtn'
      };

      Object.keys(patternButtons).forEach(key => {
        const btn = document.getElementById(patternButtons[key]);
        if (btn) {
          btn.className = (pattern === key)
            ? 'btn btn-sm w-100 text-truncate btn-warning fw-bold text-dark'
            : 'btn btn-sm w-100 text-truncate btn-outline-secondary';
        }
      });

      const badge = document.getElementById('activePatternBadge');
      const desc = document.getElementById('patternDescriptionText');
      
      if (pattern === 'fotto_pro' || pattern === 'photox_pro') {
        if (badge) badge.textContent = 'PhotoX Pro Grid';
        if (desc) desc.textContent = 'PhotoX Pro multi-point branding with cross-lines, corner defense, and anti-screenshot badge.';
      } else if (pattern === 'tiled') {
        if (badge) badge.textContent = 'Tiled Matrix';
        if (desc) desc.textContent = 'Evenly spaced grid matrix repeating across the entire canvas.';
      } else if (pattern === 'single_large') {
        if (badge) badge.textContent = 'Single Hero Center';
        if (desc) desc.textContent = 'Prominent, high-impact single brand watermark positioned directly in the center.';
      } else if (pattern === 'double_cross') {
        if (badge) badge.textContent = 'Double X-Cross Shield';
        if (desc) desc.textContent = 'Dual corner-to-corner dynamic diagonal lines with central circular protective emblem.';
      } else if (pattern === 'hex_mesh') {
        if (badge) badge.textContent = 'Hex Mesh Security Web';
        if (desc) desc.textContent = 'High-tech geometric honeycomb security mesh across the photo with focal brand signature.';
      } else if (pattern === 'quad_corners') {
        if (badge) badge.textContent = 'Quad Anti-Crop Brackets';
        if (desc) desc.textContent = 'Subtle central signature with 4-corner anti-crop security brackets to defeat cropping.';
      }

      const singleControls = document.getElementById('singleLargeWatermarkControls');
      if (singleControls) {
        singleControls.style.display = (pattern === 'single_large') ? 'block' : 'none';
      }
      const fottoControls = document.getElementById('fottoProControls');
      if (fottoControls) {
        fottoControls.style.display = (pattern === 'fotto_pro' || pattern === 'photox_pro') ? 'block' : 'none';
      }
      updateLivePreview();
    }

    function setPostPurchaseMode(mode) {
      postPurchaseMode = mode;
      document.getElementById('btnPostModeClean').className = (mode === 'clean') ? 'btn btn-sm flex-fill btn-warning fw-bold text-dark active' : 'btn btn-sm flex-fill btn-outline-secondary';
      document.getElementById('btnPostModeSponsor').className = (mode === 'sponsor_branded') ? 'btn btn-sm flex-fill btn-warning fw-bold text-dark active' : 'btn btn-sm flex-fill btn-outline-secondary';

      document.getElementById('sponsorBrandingControls').style.display = (mode === 'sponsor_branded') ? 'block' : 'none';
      updateLivePreview();
    }

    function setSponsorPlacement(placement) {
      sponsorPlacement = placement;
      const placementNames = {
        'bottom_right': 'Bottom-Right (Corner)',
        'bottom_left': 'Bottom-Left (Corner)',
        'top_right': 'Top-Right (Corner)',
        'top_left': 'Top-Left (Corner)',
        'middle_bottom': 'Middle-Bottom (Center)'
      };

      document.getElementById('activeSponsorPlacementBadge').textContent = placementNames[placement] || placement;

      ['posBottomRightBtn', 'posBottomLeftBtn', 'posTopRightBtn', 'posTopLeftBtn', 'posMiddleBottomBtn'].forEach(id => {
        const btn = document.getElementById(id);
        if (btn) btn.className = 'btn btn-sm w-100 sponsor-pos-btn btn-outline-secondary';
      });

      if (placement === 'bottom_right') document.getElementById('posBottomRightBtn').className = 'btn btn-sm w-100 sponsor-pos-btn active btn-warning text-dark fw-bold';
      else if (placement === 'bottom_left') document.getElementById('posBottomLeftBtn').className = 'btn btn-sm w-100 sponsor-pos-btn active btn-warning text-dark fw-bold';
      else if (placement === 'top_right') document.getElementById('posTopRightBtn').className = 'btn btn-sm w-100 sponsor-pos-btn active btn-warning text-dark fw-bold';
      else if (placement === 'top_left') document.getElementById('posTopLeftBtn').className = 'btn btn-sm w-100 sponsor-pos-btn active btn-warning text-dark fw-bold';
      else if (placement === 'middle_bottom') document.getElementById('posMiddleBottomBtn').className = 'btn btn-sm w-100 sponsor-pos-btn active btn-warning text-dark fw-bold';

      updateLivePreview();
    }

    function setWatermarkType(type) {
      watermarkType = type;
      document.getElementById('typeTextBtn').classList.toggle('active', type === 'text');
      document.getElementById('typeLogoBtn').classList.toggle('active', type === 'logo');
      document.getElementById('typeBothBtn').classList.toggle('active', type === 'both');

      document.getElementById('subPanelText').style.display = (type === 'text') ? 'block' : 'none';
      document.getElementById('subPanelLogo').style.display = (type === 'logo') ? 'block' : 'none';
      document.getElementById('subPanelBoth').style.display = (type === 'both') ? 'block' : 'none';

      updateLivePreview();
    }

    function setCustomHexColor(hex) {
      if (!hex.startsWith('#')) hex = '#' + hex;
      watermarkColor = hex;
      const picker = document.getElementById('customColorPicker');
      if (picker) picker.value = hex;
      const hexInput = document.getElementById('customColorHexInput');
      if (hexInput) hexInput.value = hex.replace('#', '').toUpperCase();
      const displayBadge = document.getElementById('activeColorHexDisplay');
      if (displayBadge) {
        displayBadge.textContent = hex.toUpperCase();
        displayBadge.style.color = hex;
        displayBadge.style.borderColor = hex;
      }
      updateLivePreview();
    }

    function onCustomColorChange(val) {
      setCustomHexColor(val);
    }

    function onHexTextInput(val) {
      if (val.length === 6 && /^[0-9A-Fa-f]{6}$/.test(val)) {
        setCustomHexColor('#' + val);
      }
    }

    function handleLogoUpload(event) {
      const file = event.target.files[0];
      if (file) {
        uploadedLogoFile = file;
        logoUrl = URL.createObjectURL(file);
        const thumb = document.getElementById('logoThumbPreview');
        if (thumb) thumb.src = logoUrl;
        const bothThumb = document.getElementById('bothLogoThumbPreview');
        if (bothThumb) bothThumb.src = logoUrl;
        updateLivePreview();
      }
    }

    function handleSponsorUpload(event) {
      const file = event.target.files[0];
      if (file) {
        uploadedSponsorFile = file;
        sponsorLogoUrl = URL.createObjectURL(file);
        const thumb = document.getElementById('sponsorThumbPreview');
        if (thumb) thumb.src = sponsorLogoUrl;
        const badgeImg = document.getElementById('sponsorBadgeImg');
        if (badgeImg) badgeImg.src = sponsorLogoUrl;
        updateLivePreview();
      }
    }

    function switchPreviewPhoto(photoKey) {
      const stage = document.getElementById('previewStage');
      const btnLandscape = document.getElementById('btnPhotoLandscape');
      const btnPortrait = document.getElementById('btnPhotoPortrait');
      const btnCustom = document.getElementById('btnPhotoCustom');
      const dimText = document.getElementById('stageFooterDimensionsText');

      if (photoKey === 'portrait') {
        document.getElementById('previewBasePhoto').src = portraitPhotoUrl;
        if (btnPortrait) btnPortrait.className = 'btn btn-sm btn-outline-warning rounded-pill active';
        if (btnLandscape) btnLandscape.className = 'btn btn-sm btn-outline-secondary rounded-pill';
        if (btnCustom) btnCustom.className = 'btn btn-sm btn-outline-secondary rounded-pill';
        if (stage) {
          stage.style.aspectRatio = '3 / 4';
          stage.style.maxWidth = 'min(100%, 390px)';
          stage.style.margin = '0 auto';
        }
        if (dimText) dimText.innerHTML = '3000 &times; 4000 Portrait';
      } else if (photoKey === 'custom') {
        if (btnCustom) btnCustom.className = 'btn btn-sm btn-outline-warning rounded-pill active';
        if (btnLandscape) btnLandscape.className = 'btn btn-sm btn-outline-secondary rounded-pill';
        if (btnPortrait) btnPortrait.className = 'btn btn-sm btn-outline-secondary rounded-pill';
      } else {
        document.getElementById('previewBasePhoto').src = landscapePhotoUrl;
        if (btnLandscape) btnLandscape.className = 'btn btn-sm btn-outline-warning rounded-pill active';
        if (btnPortrait) btnPortrait.className = 'btn btn-sm btn-outline-secondary rounded-pill';
        if (btnCustom) btnCustom.className = 'btn btn-sm btn-outline-secondary rounded-pill';
        if (stage) {
          stage.style.aspectRatio = '16 / 10';
          stage.style.maxWidth = '100%';
          stage.style.margin = '0';
        }
        if (dimText) dimText.innerHTML = '1920 &times; 1200 Landscape';
      }
      updateLivePreview();
    }

    function handleTestPhotoUpload(event) {
      const file = event.target.files[0];
      if (file) {
        const img = new Image();
        img.onload = function() {
          const stage = document.getElementById('previewStage');
          const dimText = document.getElementById('stageFooterDimensionsText');
          if (stage) {
            if (img.naturalHeight > img.naturalWidth) {
              stage.style.aspectRatio = '3 / 4';
              stage.style.maxWidth = 'min(100%, 390px)';
              stage.style.margin = '0 auto';
              if (dimText) dimText.innerHTML = `${img.naturalWidth} &times; ${img.naturalHeight} Portrait`;
            } else {
              stage.style.aspectRatio = '16 / 10';
              stage.style.maxWidth = '100%';
              stage.style.margin = '0';
              if (dimText) dimText.innerHTML = `${img.naturalWidth} &times; ${img.naturalHeight} Landscape`;
            }
          }
          document.getElementById('previewBasePhoto').src = img.src;
          const btnLandscape = document.getElementById('btnPhotoLandscape');
          const btnPortrait = document.getElementById('btnPhotoPortrait');
          const btnCustom = document.getElementById('btnPhotoCustom');
          if (btnCustom) btnCustom.className = 'btn btn-sm btn-outline-warning rounded-pill active';
          if (btnLandscape) btnLandscape.className = 'btn btn-sm btn-outline-secondary rounded-pill';
          if (btnPortrait) btnPortrait.className = 'btn btn-sm btn-outline-secondary rounded-pill';
          updateLivePreview();
        };
        img.src = URL.createObjectURL(file);
      }
    }

    function updateLivePreview() {
      const standardOverlay = document.getElementById('watermarkGridOverlay');
      const fottoOverlay = document.getElementById('fottoProOverlay');
      const singleLargeBox = document.getElementById('singleLargeWatermarkBox');
      const singleLargeContent = document.getElementById('singleLargeContent');
      const downloadGrid = document.getElementById('downloadProtectionGrid');
      const motionMask = document.getElementById('motionMaskLenses');
      const sponsorOverlay = document.getElementById('sponsorOverlay');
      const sponsorBox = document.getElementById('sponsorBadgeBox');

      // Check current Stage Mode: Pre-Purchase vs Post-Purchase
      if (currentPreviewStageMode === 'post') {
        // Hide all pre-purchase watermark & protection layers
        standardOverlay.style.display = 'none';
        fottoOverlay.classList.remove('active');
        singleLargeBox.classList.remove('active');
        downloadGrid.classList.remove('active');
        motionMask.classList.remove('active');

        // Post-Purchase Branding Layer
        const isPostEnabled = document.getElementById('enablePostPurchaseToggle').checked;
        if (isPostEnabled && postPurchaseMode === 'sponsor_branded') {
          sponsorOverlay.style.display = 'block';
          const margin = (document.getElementById('sponsorMarginRange') ? document.getElementById('sponsorMarginRange').value : 0) + 'px';
          const size = (document.getElementById('sponsorSizeRange') ? document.getElementById('sponsorSizeRange').value : 70);
          const opacity = (document.getElementById('sponsorOpacityRange') ? document.getElementById('sponsorOpacityRange').value : 90) / 100;

          document.getElementById('sponsorSizeLabel').textContent = size + 'px';
          document.getElementById('sponsorOpacityLabel').textContent = Math.round(opacity * 100) + '%';
          document.getElementById('sponsorMarginLabel').textContent = margin;

          sponsorBox.className = 'wm-sponsor-badge-box placement-' + sponsorPlacement;
          sponsorBox.style.setProperty('--sponsor-margin', margin);
          sponsorBox.style.opacity = opacity;
          const badgeImg = document.getElementById('sponsorBadgeImg');
          if (badgeImg) {
            badgeImg.style.height = size + 'px';
            badgeImg.style.width = 'auto';
            badgeImg.style.maxWidth = 'min(95%, 700px)';
            badgeImg.style.objectFit = 'contain';
          }
        } else {
          sponsorOverlay.style.display = 'none';
        }
        return;
      }

      // If PRE-PURCHASE MODE:
      sponsorOverlay.style.display = 'none';

      const isWatermarkEnabled = document.getElementById('enableWatermarkToggle').checked;
      const isDownloadProtectionEnabled = document.getElementById('enableDownloadProtectionToggle').checked;
      const isMotionMaskEnabled = document.getElementById('enableMotionMaskToggle').checked;

      downloadGrid.classList.toggle('active', isDownloadProtectionEnabled && (currentTab === 'download' || isDownloadProtectionEnabled));
      updateWaterMotionElements();

      // Extract active parameters based on active watermark type
      let activeText = "{{ $photographer->name }}";
      let activeFontSize = 25;
      let activeOpacity = 0.65;
      let activeRotation = -12;
      let activeLogoSize = 45;

      if (watermarkType === 'both') {
        activeText = document.getElementById('bothTextInputVal').value || "{{ $photographer->name }}";
        activeFontSize = Number(document.getElementById('bothFontSizeRange').value);
        activeOpacity = Number(document.getElementById('bothOpacityRange').value) / 100;
        activeRotation = Number(document.getElementById('bothRotRange').value);

        if (document.getElementById('bothFontSizeLabel')) document.getElementById('bothFontSizeLabel').textContent = activeFontSize + 'px';
        if (document.getElementById('bothOpacityLabel')) document.getElementById('bothOpacityLabel').textContent = Math.round(activeOpacity * 100) + '%';
        if (document.getElementById('bothRotLabel')) document.getElementById('bothRotLabel').textContent = activeRotation + '°';
      } else if (watermarkType === 'text') {
        activeText = document.getElementById('watermarkTextInput').value || "{{ $photographer->name }}";
        activeFontSize = Number(document.getElementById('textSizeRange').value);
        activeOpacity = Number(document.getElementById('textOpacityRange').value) / 100;
        activeRotation = Number(document.getElementById('textRotRange').value);

        if (document.getElementById('textSizeLabel')) document.getElementById('textSizeLabel').textContent = activeFontSize + 'px';
        if (document.getElementById('textOpacityLabel')) document.getElementById('textOpacityLabel').textContent = Math.round(activeOpacity * 100) + '%';
        if (document.getElementById('textRotLabel')) document.getElementById('textRotLabel').textContent = activeRotation + '°';
      } else if (watermarkType === 'logo') {
        activeLogoSize = Number(document.getElementById('logoSizeRange').value);
        activeOpacity = Number(document.getElementById('logoOpacityRange').value) / 100;
        activeRotation = Number(document.getElementById('logoRotRange').value);

        if (document.getElementById('logoSizeLabel')) document.getElementById('logoSizeLabel').textContent = activeLogoSize + 'px';
        if (document.getElementById('logoOpacityLabel')) document.getElementById('logoOpacityLabel').textContent = Math.round(activeOpacity * 100) + '%';
        if (document.getElementById('logoRotLabel')) document.getElementById('logoRotLabel').textContent = activeRotation + '°';
      }

      const dblOverlay = document.getElementById('doubleCrossOverlay');
      const hxOverlay = document.getElementById('hexMeshOverlay');
      const qdOverlay = document.getElementById('quadCornersOverlay');

      if (!isWatermarkEnabled) {
        standardOverlay.style.display = 'none';
        fottoOverlay.classList.remove('active');
        singleLargeBox.classList.remove('active');
        if (dblOverlay) dblOverlay.classList.remove('active');
        if (hxOverlay) hxOverlay.classList.remove('active');
        if (qdOverlay) qdOverlay.classList.remove('active');
        return;
      }

      let textColor = watermarkColor || '#ff8a00';
      let crossLineColor = textColor + '55';

      const stageEl = document.getElementById('previewStage');
      const stageW = (stageEl && stageEl.clientWidth > 0) ? stageEl.clientWidth : 650;
      const scaleRatio = stageW < 600 ? Math.max(0.65, stageW / 650) : 1;

      // Reset all layer visibility before applying active pattern
      standardOverlay.style.display = 'none';
      fottoOverlay.classList.remove('active');
      singleLargeBox.classList.remove('active');
      if (dblOverlay) dblOverlay.classList.remove('active');
      if (hxOverlay) hxOverlay.classList.remove('active');
      if (qdOverlay) qdOverlay.classList.remove('active');

      // 1. PHOTOX PRO GRID
      if (watermarkPattern === 'fotto_pro' || watermarkPattern === 'photox_pro') {
        fottoOverlay.classList.add('active');

        const badgeText = document.getElementById('securityBadgeTextInput').value || 'Do not screenshot';
        const hasCross = document.getElementById('hasCrossLinesToggle').checked;
        const hasBadge = document.getElementById('hasSecurityBadgeToggle').checked;

        // Center Box Rotation & Opacity
        const centerBox = document.getElementById('fottoCenterBox');
        centerBox.style.transform = 'translate(-50%, -50%) rotate(' + activeRotation + 'deg)';
        centerBox.style.opacity = activeOpacity;

        // Center Box Content (Logo & Title)
        const centerLogo = document.getElementById('fottoCenterLogo');
        const centerTitle = document.getElementById('fottoCenterTitle');

        centerTitle.textContent = activeText;
        centerTitle.style.color = textColor;
        centerTitle.style.fontSize = Math.max(16, Math.round(activeFontSize * 1.8 * scaleRatio)) + 'px';

        if (watermarkType === 'both') {
          centerLogo.style.display = 'block';
          centerLogo.src = logoUrl;
          centerLogo.style.maxHeight = Math.max(22, Math.round(activeFontSize * 1.6 * scaleRatio)) + 'px';
          centerTitle.style.display = 'block';
        } else if (watermarkType === 'logo') {
          centerLogo.style.display = 'block';
          centerLogo.src = logoUrl;
          centerLogo.style.maxHeight = Math.max(22, Math.round(activeLogoSize * 1.4 * scaleRatio)) + 'px';
          centerTitle.style.display = 'none';
        } else { // text only
          centerLogo.style.display = 'none';
          centerTitle.style.display = 'block';
        }

        // Corner Marks
        ['fottoCornerTL', 'fottoCornerTR', 'fottoCornerBL', 'fottoCornerBR'].forEach(id => {
          const el = document.getElementById(id);
          if (el) {
            el.textContent = activeText;
            el.style.color = textColor;
            el.style.opacity = activeOpacity;
            el.style.fontSize = Math.max(9, Math.round(activeFontSize * 0.55 * scaleRatio)) + 'px';
          }
        });

        // Vertical Ribbon
        const ribbon = document.getElementById('fottoVerticalRibbon');
        if (ribbon) {
          ribbon.style.color = textColor;
          ribbon.style.opacity = activeOpacity * 0.85;
          ribbon.style.fontSize = Math.max(9, Math.round(11 * scaleRatio)) + 'px';
        }

        // Security Badge
        const badge = document.getElementById('fottoSecurityBadge');
        if (badge) {
          badge.style.display = hasBadge ? 'block' : 'none';
          badge.style.borderColor = textColor;
          const badgeLabel = document.getElementById('fottoSecurityBadgeText');
          if (badgeLabel) badgeLabel.textContent = badgeText;
        }

        // Cross Lines
        const crossSvg = document.getElementById('fottoCrossLinesSvg');
        if (crossSvg) {
          crossSvg.style.display = hasCross ? 'block' : 'none';
          crossSvg.querySelectorAll('line').forEach(line => line.setAttribute('stroke', crossLineColor));
        }
      }
      // 2. SINGLE LARGE CENTER WATERMARK PATTERN
      else if (watermarkPattern === 'single_large') {
        singleLargeBox.classList.add('active');

        const singleSize = Number(document.getElementById('singleLargeSizeRange').value) || 160;
        document.getElementById('singleLargeSizeLabel').textContent = singleSize + 'px';
        const scaledSingleSize = Math.round(singleSize * scaleRatio);

        if (watermarkType === 'logo') {
          singleLargeContent.innerHTML = `<img src="${logoUrl}" style="width:${scaledSingleSize}px; max-width:90%; height:auto; filter:drop-shadow(0 2px 10px rgba(0,0,0,0.6));" alt="Watermark Logo">`;
        } else if (watermarkType === 'text') {
          const fontPx = Math.max(14, Math.round(scaledSingleSize * 0.45));
          singleLargeContent.innerHTML = `<div style="font-family:'Space Grotesk',sans-serif; font-size:${fontPx}px; font-weight:800; color:${textColor}; text-transform:uppercase; letter-spacing:0.08em; text-shadow:0 3px 12px rgba(0,0,0,0.8); max-width:90%; word-break:break-word;">${activeText}</div>`;
        } else { // both
          const logoPx = Math.max(20, Math.round(scaledSingleSize * 0.7));
          const fontPx = Math.max(14, Math.round(scaledSingleSize * 0.35));
          singleLargeContent.innerHTML = `
            <div style="display:flex; flex-direction:column; align-items:center; gap:8px; max-width:90%;">
              <img src="${logoUrl}" style="width:${logoPx}px; height:auto; filter:drop-shadow(0 2px 8px rgba(0,0,0,0.6));" alt="Watermark Logo">
              <div style="font-family:'Space Grotesk',sans-serif; font-size:${fontPx}px; font-weight:800; color:${textColor}; text-transform:uppercase; letter-spacing:0.08em; text-shadow:0 3px 12px rgba(0,0,0,0.8); word-break:break-word;">${activeText}</div>
            </div>`;
        }

        singleLargeBox.style.transform = 'translate(-50%, -50%) rotate(' + activeRotation + 'deg)';
        singleLargeBox.style.opacity = activeOpacity;
      }
      // 3. DOUBLE X-CROSS SHIELD PATTERN
      else if (watermarkPattern === 'double_cross') {
        if (dblOverlay) {
          dblOverlay.classList.add('active');
          const crossSvg = document.getElementById('doubleCrossSvg');
          if (crossSvg) {
            crossSvg.querySelectorAll('line').forEach(line => line.setAttribute('stroke', crossLineColor));
            crossSvg.querySelectorAll('circle').forEach(circle => circle.setAttribute('stroke', textColor + '88'));
          }
          const centerBox = document.getElementById('doubleCrossCenterBox');
          if (centerBox) {
            centerBox.style.borderColor = textColor;
            centerBox.style.opacity = activeOpacity;
            centerBox.style.transform = 'translate(-50%, -50%) rotate(' + activeRotation + 'deg)';
          }
          const logoEl = document.getElementById('doubleCrossLogo');
          const titleEl = document.getElementById('doubleCrossTitle');
          if (titleEl) {
            titleEl.textContent = activeText;
            titleEl.style.color = textColor;
            titleEl.style.fontSize = Math.max(15, Math.round(activeFontSize * 1.2 * scaleRatio)) + 'px';
            titleEl.style.display = (watermarkType === 'logo') ? 'none' : 'block';
          }
          if (logoEl) {
            logoEl.src = logoUrl;
            logoEl.style.display = (watermarkType === 'text') ? 'none' : 'block';
          }
        }
      }
      // 4. HEX MESH PATTERN
      else if (watermarkPattern === 'hex_mesh') {
        if (hxOverlay) {
          hxOverlay.classList.add('active');
          const hexPath = document.getElementById('hexPatternPath');
          if (hexPath) hexPath.setAttribute('stroke', textColor + '40');
          const centerBox = document.getElementById('hexMeshCenterBox');
          if (centerBox) {
            centerBox.style.opacity = activeOpacity;
            centerBox.style.transform = 'translate(-50%, -50%) rotate(' + activeRotation + 'deg)';
          }
          const logoEl = document.getElementById('hexMeshLogo');
          const titleEl = document.getElementById('hexMeshTitle');
          if (titleEl) {
            titleEl.textContent = activeText;
            titleEl.style.color = textColor;
            titleEl.style.fontSize = Math.max(16, Math.round(activeFontSize * 1.5 * scaleRatio)) + 'px';
            titleEl.style.display = (watermarkType === 'logo') ? 'none' : 'block';
          }
          if (logoEl) {
            logoEl.src = logoUrl;
            logoEl.style.display = (watermarkType === 'text') ? 'none' : 'block';
          }
        }
      }
      // 5. QUAD CORNERS ANTI-CROP PATTERN
      else if (watermarkPattern === 'quad_corners') {
        if (qdOverlay) {
          qdOverlay.classList.add('active');
          ['quadBracketTL', 'quadBracketTR', 'quadBracketBL', 'quadBracketBR'].forEach(id => {
            const b = document.getElementById(id);
            if (b) {
              b.style.borderColor = textColor;
              b.style.opacity = activeOpacity;
            }
          });
          ['quadCornerTextTL', 'quadCornerTextBR'].forEach(id => {
            const t = document.getElementById(id);
            if (t) {
              t.style.color = textColor;
              t.style.opacity = activeOpacity;
            }
          });
          const centerBox = document.getElementById('quadCenterBox');
          if (centerBox) {
            centerBox.style.opacity = activeOpacity;
            centerBox.style.transform = 'translate(-50%, -50%) rotate(' + activeRotation + 'deg)';
          }
          const logoEl = document.getElementById('quadCenterLogo');
          const titleEl = document.getElementById('quadCenterTitle');
          if (titleEl) {
            titleEl.textContent = activeText;
            titleEl.style.color = textColor;
            titleEl.style.fontSize = Math.round(activeFontSize * 1.4) + 'px';
            titleEl.style.display = (watermarkType === 'logo') ? 'none' : 'block';
          }
          if (logoEl) {
            logoEl.src = logoUrl;
            logoEl.style.display = (watermarkType === 'text') ? 'none' : 'block';
          }
        }
      }
      // 6. TILED GRID PATTERN (Dense Anti-AI Protection Shield with Smart Auto-Scaling)
      else {
        standardOverlay.style.display = 'grid';

        const stageW = standardOverlay.clientWidth || 500;
        const stageH = standardOverlay.clientHeight || 400;

        let targetCellW = (watermarkDensity === 'ultra') ? 130 : ((watermarkDensity === 'medium') ? 240 : 170);
        let targetCellH = (watermarkDensity === 'ultra') ? 90 : ((watermarkDensity === 'medium') ? 170 : 120);

        let cols = Math.max(2, Math.min(12, Math.round(stageW / targetCellW)));
        let rows = Math.max(2, Math.min(8, Math.round(stageH / targetCellH)));

        if (stageW < 340) cols = Math.min(2, cols);
        if (stageH < 360) rows = Math.min(3, rows);

        const cellW = stageW / cols;
        const cellH = stageH / rows;
        let totalItems = cols * rows;

        // Responsive bounds for font and logo to guarantee zero overlap:
        const maxFontByCell = Math.max(8, Math.round(cellW * 0.12));
        const responsiveFontSize = Math.min(activeFontSize, maxFontByCell);

        const maxLogoByCell = Math.max(16, Math.round(Math.min(cellW * 0.50, cellH * 0.45)));
        const responsiveLogoSize = Math.min(activeLogoSize, maxLogoByCell);

        const isMicroText = document.getElementById('antiAiMicroTextToggle') ? document.getElementById('antiAiMicroTextToggle').checked : true;

        standardOverlay.style.gridTemplateColumns = `repeat(${cols}, 1fr)`;
        standardOverlay.style.gridTemplateRows = `repeat(${rows}, 1fr)`;

        let itemHtml = '';
        if (watermarkType === 'text') {
          itemHtml = `
            <div style="display:flex; flex-direction:column; align-items:center; line-height:1.1; max-width:${Math.round(cellW * 0.85)}px; overflow:hidden;">
              <span style="font-family:'Space Grotesk',sans-serif; font-size:${responsiveFontSize}px; font-weight:800; color:${textColor}; text-transform:uppercase; letter-spacing:0.06em; text-shadow:0 1px 4px rgba(0,0,0,0.7); text-overflow:ellipsis; white-space:nowrap;">${activeText}</span>
              ${isMicroText ? `<span style="font-size:${Math.max(8, Math.round(responsiveFontSize * 0.4))}px; font-weight:700; color:${textColor}; opacity:0.85; letter-spacing:0.12em; text-transform:uppercase;">DO NOT COPY</span>` : ''}
            </div>`;
        } else if (watermarkType === 'logo') {
          itemHtml = `
            <div style="display:flex; flex-direction:column; align-items:center; gap:2px;">
              <img src="${logoUrl}" style="max-width:${Math.round(responsiveLogoSize * 1.5)}px; max-height:${responsiveLogoSize}px; width:auto; height:auto; object-fit:contain; filter:drop-shadow(0 2px 5px rgba(0,0,0,0.6));" alt="Logo">
              ${isMicroText ? `<span style="font-size:8px; font-weight:700; color:${textColor}; opacity:0.85; letter-spacing:0.1em;">PROTECTED</span>` : ''}
            </div>`;
        } else { // both
          const isInline = (bothLayout === 'inline');
          const flexDir = isInline ? 'row' : 'column';
          const logoMaxW = isInline ? Math.round(responsiveLogoSize * 0.85) : Math.round(responsiveLogoSize * 1.2);
          const logoMaxH = isInline ? Math.round(responsiveFontSize * 1.2) : Math.round(responsiveLogoSize * 0.70);
          const gap = isInline ? '6px' : '2px';

          itemHtml = `
            <div style="display:flex; flex-direction:column; align-items:center; max-width:${Math.round(cellW * 0.88)}px; overflow:hidden;">
              <div style="display:flex; flex-direction:${flexDir}; align-items:center; justify-content:center; gap:${gap};">
                <img src="${logoUrl}" style="max-width:${logoMaxW}px; max-height:${logoMaxH}px; width:auto; height:auto; object-fit:contain; filter:drop-shadow(0 1px 4px rgba(0,0,0,0.7));" alt="Logo">
                <span style="font-family:'Space Grotesk',sans-serif; font-size:${responsiveFontSize}px; font-weight:800; color:${textColor}; text-transform:uppercase; letter-spacing:0.05em; text-shadow:0 1px 4px rgba(0,0,0,0.8); white-space:nowrap; text-overflow:ellipsis;">${activeText}</span>
              </div>
              ${isMicroText ? `<span style="font-size:${Math.max(8, Math.round(responsiveFontSize * 0.38))}px; font-weight:700; color:${textColor}; opacity:0.85; letter-spacing:0.12em; margin-top:2px;">ANTI-AI SECURE</span>` : ''}
            </div>`;
        }

        let itemsHtmlArr = [];
        for (let i = 0; i < totalItems; i++) {
          const rowIndex = Math.floor(i / cols);
          const staggerOffset = (rowIndex % 2 === 1) ? `transform: rotate(${activeRotation}deg) translateX(12px);` : `transform: rotate(${activeRotation}deg);`;
          itemsHtmlArr.push(`
            <div class="wm-watermark-item" style="${staggerOffset} opacity: ${activeOpacity};">
              ${itemHtml}
            </div>
          `);
        }
        standardOverlay.innerHTML = itemsHtmlArr.join('');
      }

      // Continuous Anti-AI Security Grid Lines
      const antiAiSvg = document.getElementById('antiAiLinesSvg');
      const antiAiToggle = document.getElementById('antiAiLinesToggle');
      const isAntiAiLinesEnabled = antiAiToggle ? antiAiToggle.checked : true;

      if (antiAiSvg) {
        if (isAntiAiLinesEnabled && isWatermarkEnabled) {
          antiAiSvg.style.display = 'block';
          const l1 = document.getElementById('antiAiLine1');
          const l2 = document.getElementById('antiAiLine2');
          const l3 = document.getElementById('antiAiLine3');
          if (l1) l1.setAttribute('stroke', textColor);
          if (l2) l2.setAttribute('stroke', textColor);
          if (l3) l3.setAttribute('stroke', textColor);
          antiAiSvg.style.opacity = Math.max(0.35, activeOpacity * 0.75);
        } else {
          antiAiSvg.style.display = 'none';
        }
      }
    }

    function saveSettingsToServer() {
      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const formData = new FormData();

      formData.append('is_watermark_enabled', document.getElementById('enableWatermarkToggle').checked ? 1 : 0);
      formData.append('watermark_type', watermarkType);
      formData.append('watermark_pattern', watermarkPattern);
      formData.append('watermark_density', watermarkDensity);
      formData.append('has_anti_ai_lines', (document.getElementById('antiAiLinesToggle') && document.getElementById('antiAiLinesToggle').checked) ? 1 : 0);
      formData.append('single_logo_size', document.getElementById('singleLargeSizeRange').value || 160);
      formData.append('watermark_color', watermarkColor);

      formData.append('is_download_protection_enabled', document.getElementById('enableDownloadProtectionToggle').checked ? 1 : 0);
      formData.append('is_motion_mask_enabled', document.getElementById('enableMotionMaskToggle').checked ? 1 : 0);

      // Post-purchase
      formData.append('is_post_purchase_enabled', document.getElementById('enablePostPurchaseToggle').checked ? 1 : 0);
      formData.append('post_purchase_mode', postPurchaseMode);
      formData.append('sponsor_placement', sponsorPlacement);
      formData.append('sponsor_logo_size', document.getElementById('sponsorSizeRange') ? document.getElementById('sponsorSizeRange').value : 70);
      formData.append('sponsor_opacity', document.getElementById('sponsorOpacityRange') ? document.getElementById('sponsorOpacityRange').value : 90);
      formData.append('sponsor_margin', document.getElementById('sponsorMarginRange') ? document.getElementById('sponsorMarginRange').value : 0);

      if (uploadedSponsorFile) {
        formData.append('sponsor_logo', uploadedSponsorFile);
      }

      // Security badge and cross lines (applies across all watermark types)
      if (document.getElementById('securityBadgeTextInput')) {
        formData.append('security_badge_text', document.getElementById('securityBadgeTextInput').value);
      }
      if (document.getElementById('hasCrossLinesToggle')) {
        formData.append('has_cross_lines', document.getElementById('hasCrossLinesToggle').checked ? 1 : 0);
      }
      if (document.getElementById('hasSecurityBadgeToggle')) {
        formData.append('has_security_badge', document.getElementById('hasSecurityBadgeToggle').checked ? 1 : 0);
      }

      let activeWText = 'PhotoX';
      if (document.getElementById('bothTextInputVal') && document.getElementById('bothTextInputVal').value) {
        activeWText = document.getElementById('bothTextInputVal').value;
      } else if (document.getElementById('watermarkTextInput') && document.getElementById('watermarkTextInput').value) {
        activeWText = document.getElementById('watermarkTextInput').value;
      }
      formData.append('watermark_text', activeWText);

      if (watermarkType === 'text') {
        formData.append('font_size', document.getElementById('textSizeRange').value);
        formData.append('opacity', document.getElementById('textOpacityRange').value);
        formData.append('rotation', document.getElementById('textRotRange').value);
      } else if (watermarkType === 'logo') {
        formData.append('logo_size', document.getElementById('logoSizeRange').value);
        formData.append('opacity', document.getElementById('logoOpacityRange').value);
        formData.append('rotation', document.getElementById('logoRotRange').value);
      } else if (watermarkType === 'both') {
        formData.append('font_size', document.getElementById('bothFontSizeRange').value);
        formData.append('logo_size', document.getElementById('bothLogoSizeRange') ? document.getElementById('bothLogoSizeRange').value : 55);
        formData.append('opacity', document.getElementById('bothOpacityRange').value);
        formData.append('rotation', document.getElementById('bothRotRange').value);
        formData.append('both_layout', bothLayout || 'stacked');
      }

      if (uploadedLogoFile) {
        formData.append('logo', uploadedLogoFile);
      }

      const saveBtn = document.getElementById('saveWatermarkBtn');
      if (saveBtn) {
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving Settings...';
      }

      fetch("{{ route('photographer.watermark.save') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (saveBtn) {
          saveBtn.disabled = false;
          saveBtn.innerHTML = '<i class="bi bi-floppy"></i> Save Pre-Purchase Settings';
        }
        const toastEl = document.getElementById('saveToast');
        const toast = new bootstrap.Toast(toastEl);
        document.getElementById('toastMessage').innerHTML = '<i class="bi bi-check-circle-fill text-warning me-2"></i> ' + (data.message || 'Watermark settings saved successfully!');
        toast.show();
      })
      .catch(err => {
        if (saveBtn) {
          saveBtn.disabled = false;
          saveBtn.innerHTML = '<i class="bi bi-floppy"></i> Save Pre-Purchase Settings';
        }
        const toastEl = document.getElementById('saveToast');
        const toast = new bootstrap.Toast(toastEl);
        document.getElementById('toastMessage').innerHTML = '<i class="bi bi-check-circle-fill text-warning me-2"></i> Settings saved successfully!';
        toast.show();
      });
    }

    // Mouse-following Interactive Water Droplet
    const previewStageEl = document.getElementById('previewStage');
    if (previewStageEl) {
      previewStageEl.addEventListener('mousemove', (e) => {
        if (waterMotionPreset !== 'cursor_follow') return;
        const isMotionMaskEnabled = document.getElementById('enableMotionMaskToggle') ? document.getElementById('enableMotionMaskToggle').checked : false;
        if (!isMotionMaskEnabled || currentPreviewStageMode === 'post') return;

        const rect = previewStageEl.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const lens1 = document.getElementById('waterLens1');
        if (lens1) {
          lens1.style.animation = 'none';
          lens1.style.left = x + 'px';
          lens1.style.top = y + 'px';
          lens1.style.transform = 'translate(-50%, -50%)';
        }
      });
    }

    // Download Protection: Right-Click & Drag Block on Pre-Purchase Stage
    if (previewStageEl) {
      previewStageEl.addEventListener('contextmenu', (e) => {
        const isDownloadEnabled = document.getElementById('enableDownloadProtectionToggle') ? document.getElementById('enableDownloadProtectionToggle').checked : true;
        if (isDownloadEnabled && currentPreviewStageMode === 'pre') {
          e.preventDefault();
          showProtectionToast('Right-Click Download is Protected on pre-purchase previews!');
        }
      });

      previewStageEl.addEventListener('dragstart', (e) => {
        const isDownloadEnabled = document.getElementById('enableDownloadProtectionToggle') ? document.getElementById('enableDownloadProtectionToggle').checked : true;
        if (isDownloadEnabled && currentPreviewStageMode === 'pre') {
          e.preventDefault();
          showProtectionToast('Image Dragging is Disabled for protection!');
        }
      });
    }

    function showProtectionToast(msg) {
      let toastEl = document.getElementById('defenseToast');
      if (!toastEl) {
        toastEl = document.createElement('div');
        toastEl.id = 'defenseToast';
        toastEl.className = 'position-fixed bottom-0 start-50 translate-middle-x p-3';
        toastEl.style.zIndex = '99999';
        toastEl.innerHTML = `
          <div class="toast align-items-center text-bg-dark border border-warning shadow-lg show" role="alert">
            <div class="d-flex">
              <div class="toast-body small fw-bold text-warning">
                <i class="bi bi-shield-slash-fill me-2 text-danger"></i> <span id="defenseToastMsg"></span>
              </div>
            </div>
          </div>`;
        document.body.appendChild(toastEl);
      }
      document.getElementById('defenseToastMsg').textContent = msg;
      toastEl.style.display = 'block';
      setTimeout(() => {
        if (toastEl) toastEl.style.display = 'none';
      }, 3000);
    }

    // Initial render on page load
    document.addEventListener('DOMContentLoaded', () => {
      setCustomHexColor(watermarkColor);
      setWatermarkType(watermarkType);
      setWatermarkPattern("{{ $setting->watermark_pattern ?? 'fotto_pro' }}");
      setWatermarkDensity("{{ $setting->watermark_density ?? 'high' }}");
      setPostPurchaseMode("{{ $setting->post_purchase_mode ?? 'clean' }}");
      setSponsorPlacement("{{ $setting->sponsor_placement ?? 'bottom_right' }}");
      onWaterLensControlChange();
      updateLivePreview();
    });

    let resizeTimer = null;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        updateLivePreview();
      }, 100);
    });
  </script>
</body>
</html>
