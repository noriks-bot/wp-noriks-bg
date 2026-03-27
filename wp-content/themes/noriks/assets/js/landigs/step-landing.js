(function () {
  var config = window.noriksStepLandingConfig || {};
  var skuMap = config.skuMap || {};

  function enableOptionButton(button) {
    button.disabled = false;
    button.removeAttribute("disabled");
    button.setAttribute("aria-disabled", "false");
    button.style.pointerEvents = "auto";
    button.style.opacity = "1";
    button.style.textDecoration = "none";
    button.style.filter = "none";
    button.style.cursor = "pointer";
    button.classList.remove("disabled");
    button.classList.remove("out-of-stock");
    button.classList.remove("unavailable");
    button.classList.remove("deactivated");
    button.classList.remove("button-variation-disabled");
    button.classList.remove("greyOut");
    button.classList.remove("hiddenvariation");
  }

  function applyConfiguredOptionGroups() {
    var groups = config.optionGroups || {};
    var primary = groups.primary || {};
    var secondary = groups.secondary || {};
    var root = document.querySelector(".single-variation-container");

    if (!root) {
      return;
    }

    if (primary.label) {
      var primaryLabel = document.getElementById("selected-color-variation-name");
      if (primaryLabel) {
        primaryLabel.textContent = primary.label + ": ";
      }
    }

    if (primary.options && primary.options.length) {
      var primaryValue = document.getElementById("selected-color-variation-value");
      var primaryWrapper = root.querySelector(".color-variations-wrapper");

      if (primaryValue) {
        primaryValue.textContent = primary.options[0].name || "";
      }

      if (primaryWrapper) {
        primaryWrapper.innerHTML = "";

        primary.options.forEach(function (option, index) {
          var item = document.createElement("div");
          item.className = "color-variation";

          var button = document.createElement("button");
          button.type = "button";
          button.className = "color-variation-button" + (index === 0 ? " selected" : "");
          button.setAttribute("selected-option", index === 0 ? "true" : "false");
          button.style.background = option.value || "#111111";
          button.title = option.name || "";

          button.addEventListener("click", function () {
            primaryWrapper.querySelectorAll(".color-variation-button").forEach(function (btn) {
              btn.classList.remove("selected");
              btn.setAttribute("selected-option", "false");
            });

            button.classList.add("selected");
            button.setAttribute("selected-option", "true");

            if (primaryValue) {
              primaryValue.textContent = option.name || "";
            }
          });

          item.appendChild(button);
          primaryWrapper.appendChild(item);
        });
      }
    }

    var secondaryLabel = root.querySelector(".other-property-label");
    var secondaryButtons = root.querySelectorAll(".button-variation");

    if (secondary.hidden) {
      if (secondaryLabel) {
        secondaryLabel.parentElement.style.display = "none";
      }
      secondaryButtons.forEach(function (button) {
        button.style.display = "none";
      });
      return;
    }

    if (secondary.label && secondaryLabel) {
      secondaryLabel.textContent = secondary.label;
    }

    if (secondary.options && secondary.options.length && secondaryButtons.length) {
      secondaryButtons.forEach(function (button, index) {
        var option = secondary.options[index];

        if (!option) {
          button.style.display = "none";
          return;
        }

        button.style.display = "";
        button.textContent = option.name || "";
        enableOptionButton(button);
        button.classList.toggle("selected", index === 0);
        button.setAttribute("selected-option", index === 0 ? "true" : "false");
        button.removeAttribute("selected");
        if (index === 0) {
          button.setAttribute("selected", "selected");
        }

        button.onclick = null;
        button.addEventListener("click", function () {
          secondaryButtons.forEach(function (btn) {
            btn.classList.remove("selected");
            btn.setAttribute("selected-option", "false");
            btn.removeAttribute("selected");
          });

          button.classList.add("selected");
          button.setAttribute("selected-option", "true");
          button.setAttribute("selected", "selected");
        });
      });
    }
  }

  function normalizeSecondaryButtons() {
    document.querySelectorAll(".single-variation-container .button-variation").forEach(function (button) {
      enableOptionButton(button);
    });
  }

  function applyConfiguredOffers() {
    var offers = config.offers || [];
    if (!offers.length) {
      return;
    }

    var rows = document.querySelectorAll(".choose-qty .row");
    if (!rows.length) {
      return;
    }

    rows.forEach(function (row, index) {
      var offer = offers[index];
      var input = row.querySelector("input[type='radio']");
      var label = row.querySelector(".qty-item");
      var title = row.querySelector(".quantity-title");
      var subtitle = row.querySelector(".quantity-subtitle");
      var popular = row.querySelector(".popular .customer-favorite");
      var banner = row.querySelector(".quantity-banner");

      if (!offer) {
        row.style.display = "none";
        return;
      }

      row.style.display = "";

      if (input) {
        input.dataset.qty = String(offer.quantity);
        input.checked = !!offer.selected;
      }

      if (title) {
        title.childNodes[0].nodeValue = offer.title + " ";
      }

      if (subtitle && offer.subtitle) {
        subtitle.childNodes[0].nodeValue = offer.subtitle + " ";
      }

      if (popular) {
        if (offer.badge) {
          popular.textContent = offer.badge;
          popular.parentElement.style.display = "";
        } else {
          popular.parentElement.style.display = "none";
        }
      }

      if (banner) {
        if (offer.badge) {
          banner.textContent = offer.badge;
          banner.style.display = "";
        } else {
          banner.style.display = "none";
        }
      }

      if (label) {
        label.removeAttribute("onclick");
        label.addEventListener("click", function () {
          rows.forEach(function (innerRow) {
            var innerInput = innerRow.querySelector("input[type='radio']");
            if (innerInput) {
              innerInput.checked = false;
            }
          });

          if (input) {
            input.checked = true;
          }

          syncBuyButtons();
        });
      }
    });
  }

  function initRelatedProductSizes() {
    document.querySelectorAll(".related-product-size-options").forEach(function (group) {
      var hiddenInput = group.querySelector("input[type='hidden']");
      var buttons = group.querySelectorAll(".related-product-size-button");

      buttons.forEach(function (button, index) {
        if (button.dataset.noriksBound === "true") {
          return;
        }

        button.dataset.noriksBound = "true";

        if (index === 0 && hiddenInput && !hiddenInput.value) {
          hiddenInput.value = button.dataset.size || button.textContent.trim();
        }

        button.addEventListener("click", function () {
          buttons.forEach(function (other) {
            other.classList.remove("is-selected");
          });

          button.classList.add("is-selected");

          if (hiddenInput) {
            hiddenInput.value = button.dataset.size || button.textContent.trim();
          }
        });
      });
    });
  }

  function currentVariation() {
    if (typeof propertiesArr === "undefined" || typeof variationsArr === "undefined") {
      return null;
    }

    var selectedOptionIds = [];

    for (var p = 0; p < propertiesArr.length; p += 1) {
      var propertyId = propertiesArr[p].id;
      var selected = document.querySelector(
        "[property-id='" + propertyId + "'][selected-option='true']"
      );

      if (selected) {
        selectedOptionIds.push(selected.value);
      }
    }

    if (!selectedOptionIds.length) {
      return variationsArr[0] || null;
    }

    for (var i = 0; i < variationsArr.length; i += 1) {
      var variation = variationsArr[i];
      var ids = (variation.ids || []).slice().sort().join(",");
      var selectedIds = selectedOptionIds.slice().sort().join(",");

      if (ids === selectedIds) {
        return variation;
      }
    }

    return null;
  }

  function selectedQuantity() {
    var qtyInput = document.getElementById("single-quantity-value");
    if (qtyInput && qtyInput.value) {
      return parseInt(qtyInput.value, 10) || 1;
    }

    var checkedQty = document.querySelector("[id^='qty']:checked");
    if (checkedQty) {
      if (checkedQty.dataset.qty) {
        return parseInt(checkedQty.dataset.qty, 10) || 1;
      }
      var match = checkedQty.id.match(/(\d+)$/);
      if (match) {
        return parseInt(match[1], 10) || 1;
      }
    }

    return 1;
  }

  function addToCartUrl() {
    if (config.simpleProduct && config.productId) {
      var simpleUrl = new URL(config.targetProductUrl || config.homeUrl);
      simpleUrl.searchParams.set("add-to-cart", String(config.productId));
      simpleUrl.searchParams.set("quantity", String(selectedQuantity()));
      return simpleUrl.toString();
    }

    var variation = currentVariation();
    if (!variation || !variation.sku || !skuMap[variation.sku] || !config.productId) {
      return null;
    }

    var mapped = skuMap[variation.sku];
    var url = new URL(config.homeUrl);
    url.searchParams.set("add-to-cart", String(config.productId));
    url.searchParams.set("variation_id", String(mapped.id));
    url.searchParams.set("attribute_pa_barva", mapped.b || "");
    url.searchParams.set("attribute_pa_velikost", mapped.v || "");
    url.searchParams.set("quantity", String(selectedQuantity()));
    return url.toString();
  }

  function rewriteAnchors() {
    document.querySelectorAll("a[href='https://ortowp.noriks.com/product/stepease/']").forEach(function (link) {
      link.href = config.landingUrl;
    });

    document.querySelectorAll("a[href='https://ortowp.noriks.com/cart/']").forEach(function (link) {
      link.href = config.cartUrl;
    });

    document.querySelectorAll("a[href='https://ortowp.noriks.com/kosarica/?add-more='], a.header__cart").forEach(function (link) {
      link.href = config.cartUrl;
      link.classList.add("xoo-wsc-cart-trigger");
    });

    document.querySelectorAll("a[href='https://ortowp.noriks.com/']").forEach(function (link) {
      link.href = config.homeUrl;
    });
  }

  function syncBuyButtons() {
    var buttons = document.querySelectorAll(".hs-cf-cart-btn, [id$='-hs-cf-add-to-cart'], .checkout-add-to-cart-btn");

    buttons.forEach(function (button) {
      button.setAttribute("href", "#");
      button.style.cursor = "pointer";
      button.style.pointerEvents = "auto";
      button.style.opacity = "1";
      button.classList.remove("checkout-add-to-cart-btn-disabled");
      button.classList.remove("hs-add-to-cart-disabled");
      button.removeAttribute("disabled");
      button.setAttribute("aria-disabled", "false");
    });
  }

  function getAjaxEndpoint(endpoint) {
    if (window.xoo_wsc_params && window.xoo_wsc_params.wc_ajax_url) {
      return window.xoo_wsc_params.wc_ajax_url.toString().replace("%%endpoint%%", endpoint);
    }

    return null;
  }

  function buildAddToCartPayload() {
    var formData = new FormData();
    var quantity = selectedQuantity();

    formData.append("action", "xoo_wsc_add_to_cart");
    formData.append("add-to-cart", String(config.productId));
    formData.append("quantity", String(quantity));

    if (!config.simpleProduct) {
      var variation = currentVariation();
      var mapped = variation && variation.sku ? skuMap[variation.sku] : null;

      if (!mapped) {
        return null;
      }

      formData.append("product_id", String(config.productId));
      formData.append("variation_id", String(mapped.id));
      formData.append("attribute_pa_barva", mapped.b || "");
      formData.append("attribute_pa_velikost", mapped.v || "");
    }

    return formData;
  }

  function openSidecart(trigger) {
    var cartTrigger = document.querySelector(".xoo-wsc-cart-trigger");
    if (cartTrigger) {
      cartTrigger.dispatchEvent(new MouseEvent("click", { bubbles: true, cancelable: true }));
    }
  }

  function addToCartAjax(trigger) {
    var endpoint = getAjaxEndpoint("xoo_wsc_add_to_cart");
    var payload = buildAddToCartPayload();

    if (!endpoint || !payload) {
      return Promise.reject(new Error("missing-endpoint"));
    }

    trigger.classList.add("loading");

    return fetch(endpoint, {
      method: "POST",
      credentials: "same-origin",
      body: payload
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (response) {
        if (response && response.fragments && window.jQuery) {
          window.jQuery(document.body).trigger("added_to_cart", [response.fragments, response.cart_hash || "", window.jQuery(trigger)]);
          return response;
        }

        if (response && response.error) {
          throw new Error("cart-error");
        }

        throw new Error("invalid-response");
      })
      .finally(function () {
        trigger.classList.remove("loading");
        trigger.classList.add("added");
      });
  }

  function handleBuyClick(event) {
    var trigger = event.target.closest(".hs-cf-cart-btn, [id$='-hs-cf-add-to-cart'], .checkout-add-to-cart-btn");
    if (!trigger) {
      return;
    }

    event.preventDefault();
    addToCartAjax(trigger)
      .then(function () {
        openSidecart(trigger);
      })
      .catch(function () {
        window.alert("Dodavanje u košaricu trenutno nije dostupno. Provjeri sidecart/plugin konfiguraciju.");
      });
  }

  function refresh() {
    applyConfiguredOptionGroups();
    normalizeSecondaryButtons();
    applyConfiguredOffers();
    initRelatedProductSizes();
    rewriteAnchors();
    syncBuyButtons();

    document.documentElement.classList.remove("noriks-landings-pending");
  }

  document.addEventListener("click", handleBuyClick, true);

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", refresh);
  } else {
    refresh();
  }

  if (typeof window.setLinkDynamicCart === "function") {
    var originalSetLinkDynamicCart = window.setLinkDynamicCart;
    window.setLinkDynamicCart = function () {
      var result = originalSetLinkDynamicCart.apply(this, arguments);
      setTimeout(refresh, 50);
      return result;
    };
  }

  setInterval(refresh, 1500);
})();
