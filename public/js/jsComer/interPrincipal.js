document.addEventListener('DOMContentLoaded', () => {

  /* =====================
     SCROLL DE PRODUCTOS
  ====================== */
  document.querySelectorAll('.scroll-controls button').forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.dataset.scrollTarget;
      const dir = Number(btn.dataset.dir) || 1;
      const container = document.getElementById(targetId);
      if (!container) return;
      const offset = Math.round(container.clientWidth * 0.7) * dir;
      container.scrollBy({ left: offset, behavior: 'smooth' });
    });
  });

  document.querySelectorAll('.products').forEach(p => {
    p.setAttribute('tabindex','0');
    p.addEventListener('keydown', e => {
      if (e.key === 'ArrowRight') p.scrollBy({ left: 220, behavior: 'smooth' });
      if (e.key === 'ArrowLeft')  p.scrollBy({ left: -220, behavior: 'smooth' });
    });
  });

  /* =====================
     DRAWER CARRITO
  ====================== */
  const openCart   = document.getElementById('openCart');
  const closeCart  = document.getElementById('closeCart');
  const cartDrawer = document.getElementById('cartDrawer');
  const cartOverlay= document.getElementById('cartOverlay');

  openCart?.addEventListener('click', () => {
    cartDrawer.classList.add('active');
    cartOverlay.classList.add('active');
  });

  function closeDrawer() {
    cartDrawer.classList.remove('active');
    cartOverlay.classList.remove('active');
  }

  closeCart?.addEventListener('click', closeDrawer);
  cartOverlay?.addEventListener('click', closeDrawer);

  /* =====================
     CARRITO
  ====================== */
  let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

  const cartContent = document.querySelector('.cart-content');
  const cartCountEl = document.getElementById('cartCount');
  const checkoutBtn = document.getElementById('btnCheckout');
  const btnLoginRequired = document.getElementById('btnLoginRequired');



  function renderCarrito() {
    cartContent.innerHTML = '';

    if (carrito.length === 0) {
      cartContent.innerHTML = '<p>Tu carrito está vacío</p>';
      cartCountEl.style.display = 'none';
      return;
    }

    carrito.forEach((prod, index) => {
      const div = document.createElement('div');
      div.classList.add('cart-item');

      div.innerHTML = `
        <strong>${prod.nombre}</strong><br>
        Temática: ${prod.tematica}<br>
        Cantidad: ${prod.cantidad}
        <button class="remove-item" data-index="${index}">✖</button>
        <hr>
      `;

      cartContent.appendChild(div);
    });

    const totalItems = carrito.reduce((acc, p) => acc + p.cantidad, 0);
    cartCountEl.textContent = totalItems;
    cartCountEl.style.display = 'flex';

    localStorage.setItem('carrito', JSON.stringify(carrito));
  }

  /* =====================
     AGREGAR PRODUCTO
  ====================== */
  document.querySelectorAll('.product').forEach(producto => {
    producto.addEventListener('click', () => {
      const data = JSON.parse(producto.dataset.producto);
      const tematica = producto.dataset.tematica;

      const existente = carrito.find(p => p.idProducto === data.idProducto);

      if (existente) {
        existente.cantidad++;
      } else {
        carrito.push({ ...data, tematica, cantidad: 1 });
      }

      renderCarrito();
    });
  });

  /* =====================
     ELIMINAR PRODUCTO
  ====================== */
  cartContent.addEventListener('click', e => {
    if (e.target.classList.contains('remove-item')) {
      const index = e.target.dataset.index;
      carrito.splice(index, 1);
      renderCarrito();
    }
  });


 
  /* =====================
   CHECKOUT (SOLO LOGUEADOS)
====================== */

if (checkoutBtn) {
  checkoutBtn.addEventListener('click', (e) => {
    

   

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/ventaPedido/opciones/opciones';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'carrito';
    input.value = JSON.stringify(carrito);

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
  });
}

  if (btnLoginRequired) {
  btnLoginRequired.addEventListener('click', (e) => {
    e.preventDefault();

    alert('Debes iniciar sesión o registrarte para finalizar la compra');
    window.location.href = '/ventaPedido/inicio/inicioSesionCliente';
  });

    if (carrito.length === 0) {
      alert('El carrito está vacío');
      return;
    }
      
}






  /* =====================
     INIT
  ====================== */
  renderCarrito();

});

