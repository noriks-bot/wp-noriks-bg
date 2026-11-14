<?php
/* Tabela velikosti bokseric. Vkljucena v okno s tabelami in v razdelek na strani izdelka. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
      <!-- BOXERS: HTML size table (replaces the image) -->
      <div class="noriks-bx">
        <style>
          .noriks-bx { width: 100%; box-sizing: border-box; color: #111;
                       font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
          .noriks-bx-wrap { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
          table.noriks-bx-t { width: 100%; min-width: 460px; border-collapse: collapse; font-size: 14px; }
          table.noriks-bx-t th, table.noriks-bx-t td { border: 1px solid #e3e3e3; padding: 9px 6px; text-align: center; }
          table.noriks-bx-t thead th { background: #111; color: #fff; font-weight: 800; border-color: #111; }
          table.noriks-bx-t tbody th { background: #f6f6f6; font-weight: 800; width: 54px; }
          table.noriks-bx-t tbody tr:nth-child(even) td { background: #fafafa; }
          .noriks-bx-note { margin: 14px 0 0; font-size: 13.5px; line-height: 1.6; color: #444; }
          .noriks-bx-note strong { color: #111; }
          .noriks-bx-fig { display: block !important; width: 100% !important; max-width: 340px !important;
                           height: auto !important; margin: 16px auto 0 !important; }
          @media (max-width: 600px) {
            table.noriks-bx-t { font-size: 12px; min-width: 420px; }
            table.noriks-bx-t th, table.noriks-bx-t td { padding: 7px 4px; }
            .noriks-bx-note { font-size: 12.5px; }
            /* na mobitelu je crtez bio prevelik — smanjen na trecinu */
            .noriks-bx-fig { max-width: 120px !important; margin-top: 12px !important; }
          }
        </style>
        <div class="noriks-bx-wrap">
          <table class="noriks-bx-t">
            <thead>
              <tr><th>Размер</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>2XL</th><th>3XL</th><th>4XL</th></tr>
            </thead>
            <tbody>
              <tr><th>a</th><td>32</td><td>34</td><td>36</td><td>38</td><td>40</td><td>42</td><td>44</td></tr>
              <tr><th>b</th><td>33,5</td><td>34,5</td><td>35,5</td><td>36,5</td><td>37,5</td><td>38,5</td><td>39,5</td></tr>
              <tr><th>c</th><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td></tr>
              <tr><th>d</th><td>29</td><td>30</td><td>31</td><td>32</td><td>33</td><td>34</td><td>35</td></tr>
            </tbody>
          </table>
        </div>
