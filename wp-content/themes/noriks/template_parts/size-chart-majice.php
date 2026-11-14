<?php
/* Tabela velikosti majic (visina x teza). Vkljucena v okno s tabelami in v razdelek na strani izdelka. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
      <!-- MAJICE: HTML size chart (visina x teza matrika) -->
      <div class="noriks-size-chart-wrap">
        <style>
          .noriks-size-chart-wrap {
            width: 100%;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #111;
          }
          .noriks-sc-table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
          }
          /* MOBILE: force horizontal scrollbar to be ALWAYS visible, fat + orange */
          @media (max-width: 768px) {
            .noriks-sc-table-wrap {
              overflow-x: scroll !important;
              padding-bottom: 10px;
              scrollbar-width: auto;
              scrollbar-color: #f39c13 rgba(0,0,0,0.10);
              background:
                linear-gradient(90deg, #fff 30%, rgba(255,255,255,0)) left center / 24px 100% no-repeat,
                linear-gradient(90deg, rgba(255,255,255,0), #fff 70%) right center / 24px 100% no-repeat,
                linear-gradient(90deg, rgba(0,0,0,0.12), rgba(0,0,0,0)) left center / 18px 100% no-repeat,
                linear-gradient(90deg, rgba(0,0,0,0), rgba(0,0,0,0.12)) right center / 18px 100% no-repeat;
              background-attachment: local, local, scroll, scroll;
            }
            .noriks-sc-table-wrap::-webkit-scrollbar {
              height: 12px !important;
              -webkit-appearance: none;
              background: rgba(0,0,0,0.10);
            }
            .noriks-sc-table-wrap::-webkit-scrollbar-track {
              background: rgba(0,0,0,0.10);
              border-radius: 6px;
              border: 1px solid rgba(0,0,0,0.15);
            }
            .noriks-sc-table-wrap::-webkit-scrollbar-thumb {
              background: #f39c13;
              border-radius: 6px;
              border: 2px solid rgba(0,0,0,0.10);
              min-width: 50px;
            }
            .noriks-sc-table-wrap::-webkit-scrollbar-thumb:active,
            .noriks-sc-table-wrap::-webkit-scrollbar-thumb:hover {
              background: #d97f00;
            }
          }
          table.noriks-sc {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            font-size: 14px;
            table-layout: fixed;
          }
          /* Mobile: keep horizontal scroll with readable min-width */
          @media (max-width: 768px) {
            table.noriks-sc { min-width: 780px; font-size: 10.4px; }
          }
          /* Desktop: fit fully within modal, no horizontal scroll */
          @media (min-width: 769px) {
            table.noriks-sc { min-width: 0; font-size: 14px; }
          }
          table.noriks-sc th, table.noriks-sc td {
            border: 2px solid #fff;
            text-align: center;
            padding: 9px 2px;
            background: #ececec;
            font-weight: 600;
            color: #111;
            white-space: nowrap;
            word-break: keep-all;
          }
          @media (min-width: 769px) {
            table.noriks-sc th, table.noriks-sc td { padding: 10px 3px; }
          }
          table.noriks-sc thead th {
            background: #b8b8b8;
            color: #000;
            font-weight: 700;
          }
          table.noriks-sc thead th.noriks-sc-empty { background: #b8b8b8; }
          table.noriks-sc tbody th {
            background: #b8b8b8;
            font-weight: 700;
          }
          table.noriks-sc tbody th.noriks-sc-vis-label {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            background: #b8b8b8;
            color: #000;
            width: 32px;
            letter-spacing: 1px;
          }
          /* Sticky col 1 (Visina label) + col 2 (Velikost / height column) on horizontal scroll */
          table.noriks-sc thead th:first-child,
          table.noriks-sc tbody th.noriks-sc-vis-label {
            position: sticky;
            left: 0;
            z-index: 5;
            background: #b8b8b8;
          }
          table.noriks-sc thead th:nth-child(2),
          table.noriks-sc tbody tr > th:nth-of-type(2),
          table.noriks-sc tbody tr:not(:first-child) > th:first-of-type {
            position: sticky;
            left: 42px;
            z-index: 4;
            background: #b8b8b8;
            box-shadow: 3px 0 5px -2px rgba(0,0,0,0.18);
          }
          /* Make weight header row sticky vertically too */
          table.noriks-sc thead th {
            position: sticky;
            top: 0;
            z-index: 6;
            background: #b8b8b8;
          }
          /* Top-left sticky corners need higher z so they win */
          table.noriks-sc thead th:first-child { z-index: 9; }
          table.noriks-sc thead th:nth-child(2) { z-index: 8; }
          table.noriks-sc td.noriks-sc-empty { background: #ececec; color: transparent; }
          table.noriks-sc td.noriks-sc-size {
            background: #d9d9d9;
            color: #000;
            font-weight: 700;
            transition: background-color 0.15s ease, transform 0.15s ease;
          }
          /* Desktop hover: highlight ONLY the hovered cell */
          @media (hover: hover) and (min-width: 769px) {
            table.noriks-sc td.noriks-sc-size:hover {
              background: #f39c13 !important;
              color: #fff !important;
              transform: scale(1.06);
              box-shadow: 0 2px 10px rgba(0,0,0,0.22);
              position: relative;
              z-index: 2;
            }
          }
          .noriks-sc-steps {
            margin-top: 22px;
          }
          .noriks-sc-steps h3 {
            margin: 0 0 12px;
            font-size: 16px;
            font-weight: 800;
            color: #111;
          }
          .noriks-sc-steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
          }
          .noriks-sc-step {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 13px;
            line-height: 1.4;
            color: #222;
          }
          .noriks-sc-step .noriks-sc-num {
            flex: 0 0 22px;
            width: 22px; height: 22px;
            border-radius: 50%;
            background: #111;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
          }
          .noriks-sc-pro {
            margin-top: 16px;
            border: 1.5px solid #f39c13;
            border-radius: 4px;
            padding: 10px 12px;
            background: #fff8ec;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            line-height: 1.4;
          }
          .noriks-sc-pro-tag {
            background: #f39c13;
            color: #fff;
            font-weight: 800;
            font-size: 11px;
            padding: 5px 9px;
            border-radius: 2px;
            letter-spacing: 0.5px;
            flex: 0 0 auto;
            white-space: nowrap;
          }
          .noriks-sc-guarantee {
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #222;
          }
          .noriks-sc-check {
            width: 20px; height: 20px;
            border-radius: 50%;
            background: #2ecc40;
            color: #fff;
            font-weight: 800;
            font-size: 13px;
            display: flex; align-items: center; justify-content: center;
            flex: 0 0 auto;
          }
          @media (max-width: 600px) {
            .noriks-sc-steps-grid { grid-template-columns: 1fr; }
            table.noriks-sc { font-size: 9.6px; min-width: 760px; margin: 0; }
            .noriks-sc-steps { margin-top: 5px; padding: 0 5px; }
            .noriks-size-chart-wrap { padding: 0; }
            .noriks-sc-steps h3 { font-size: 13px; }
            .noriks-sc-step { font-size: 10.4px; }
            .noriks-sc-step .noriks-sc-num { flex: 0 0 18px; width: 18px; height: 18px; font-size: 10px; }
            .noriks-sc-pro { font-size: 10.4px; padding: 8px 10px; margin-left: 5px; margin-right: 5px; }
            .noriks-sc-pro-tag { font-size: 9px; padding: 4px 7px; }
            .noriks-sc-guarantee { font-size: 10.4px; padding: 0 5px; }
            .noriks-sc-check { width: 16px; height: 16px; font-size: 10.4px; }
          }
        </style>

        <div class="noriks-sc-table-wrap">
          <table class="noriks-sc">
            <thead>
              <tr>
                <th class="noriks-sc-empty" style="width:42px;"></th>
                <th class="noriks-sc-empty" style="width:80px;">Размер</th>
                <th>59-68 kg</th>
                <th>69-77 kg</th>
                <th>78-84 kg</th>
                <th>84-95 kg</th>
                <th>96-102 kg</th>
                <th>103-113 kg</th>
                <th>114-129 kg</th>
                <th>130-136 kg</th>
                <th>137-150 kg</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="noriks-sc-vis-label" rowspan="11">Височина (cm)</th>
                <th>168 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td>
              </tr>
              <tr>
                <th>170 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td><td class="noriks-sc-empty"></td>
              </tr>
              <tr>
                <th>173 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>175 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>178 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>180 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>183 cm</th>
                <td class="noriks-sc-size">S</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>185 cm</th>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>188 cm</th>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>191 cm</th>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
              <tr>
                <th>193 cm</th>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-empty"></td>
                <td class="noriks-sc-size">M</td>
                <td class="noriks-sc-size">L</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">XL</td>
                <td class="noriks-sc-size">2XL</td>
                <td class="noriks-sc-size">3XL</td>
                <td class="noriks-sc-size">3XL</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="noriks-sc-steps">
          <h3>Как да намерите своя размер</h3>
          <div class="noriks-sc-steps-grid">
            <div class="noriks-sc-step">
              <span class="noriks-sc-num">1</span>
              <span>Намери своята <strong>височина</strong> в лявата колона.</span>
            </div>
            <div class="noriks-sc-step">
              <span class="noriks-sc-num">2</span>
              <span>Намери своето <strong>тегло</strong> в горния ред.</span>
            </div>
            <div class="noriks-sc-step">
              <span class="noriks-sc-num">3</span>
              <span>Полето, където се пресичат &mdash; това е твоят размер.</span>
            </div>
          </div>
        </div>

        <div class="noriks-sc-pro">
          <span class="noriks-sc-pro-tag">PRO TIP</span>
          <span>Ако си между два размера и искаш <strong>по-свободна кройка</strong>, вземи по-големия. За <strong>по-прилепнал вид</strong> вземи по-малкия.</span>
        </div>

        <div class="noriks-sc-guarantee">
          <span class="noriks-sc-check">&#10003;</span>
          <span>Не си сигурен? Замяна на размера до 30 дни.</span>
        </div>
      </div>
