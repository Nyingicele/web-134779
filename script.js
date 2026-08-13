/* ============================================
   UNITRADE — External JavaScript File
   JS Assignment: Web Development Lab
============================================ */

/* ============================================
   1. WELCOME MESSAGE (Homepage only)
============================================ */
function showWelcomeMessage() {
  const banner = document.getElementById('welcome-banner');
  if (!banner) return; 
  const stored = sessionStorage.getItem('unitrade_username');
  if (stored) {
    banner.textContent = '👋 Welcome back, ' + stored + '! Ready to find your next great deal?';
    banner.style.display = 'block';
    return;
  }

  const name = prompt('Welcome to UniTrade! What is your name?');
  if (name && name.trim() !== '') {
    const cleanName = name.trim();
    sessionStorage.setItem('unitrade_username', cleanName);
    banner.textContent = '👋 Hi ' + cleanName + ', welcome to UniTrade — your campus exchange platform!';
    banner.style.display = 'block';
  }
}

   2. FORM VALIDATION — Registration Form
============================================ */
function validateRegisterForm(e) {
  e.preventDefault();
  let valid = true;

  
  function setError(id, show) {
    const field = document.getElementById(id);
    const error = document.getElementById(id + '-error');
    if (!field || !error) return;
    if (show) {
      field.classList.add('error');
      error.classList.add('visible');
      valid = false;
    } else {
      field.classList.remove('error');
      error.classList.remove('visible');
    }
  }

  const fname    = document.getElementById('fname');
  const lname    = document.getElementById('lname');
  const email    = document.getElementById('email');
  const sid      = document.getElementById('student_id');
  const uni      = document.getElementById('university');
  const year     = document.getElementById('year');
  const faculty  = document.getElementById('faculty');
  const password = document.getElementById('password');
  const confirm  = document.getElementById('confirm_password');
  const terms    = document.getElementById('terms');

  setError('fname',            !fname.value.trim());
  setError('lname',            !lname.value.trim());
  setError('email',            !email.value.trim() || !email.value.includes('@'));
  setError('student_id',       !sid.value.trim());
  setError('university',       !uni.value);
  setError('year',             !year.value);
  setError('faculty',          !faculty.value.trim());
  setError('password',         password.value.length < 8);
  setError('confirm_password', confirm.value !== password.value || confirm.value === '');
  setError('terms',            !terms.checked);

  if (valid) {
    // All good — show confirmation then submit
    const btn = document.querySelector('#registerForm .submit-btn');
    btn.textContent = '✓ Submitting...';
    btn.style.background = 'var(--green-dark)';
    document.getElementById('registerForm').submit();
  }
}

/* ============================================
   3. FORM VALIDATION — Contact Form
============================================ */
function validateContactForm(e) {
  e.preventDefault();
  let valid = true;

  function setError(id, show) {
    const field = document.getElementById(id);
    const error = document.getElementById(id + '-error');
    if (!field || !error) return;
    if (show) {
      field.classList.add('error');
      error.classList.add('visible');
      valid = false;
    } else {
      field.classList.remove('error');
      error.classList.remove('visible');
    }
  }

  const name    = document.getElementById('c_name');
  const email   = document.getElementById('c_email');
  const reason  = document.getElementById('c_reason');
  const subject = document.getElementById('c_subject');
  const message = document.getElementById('c_message');

  setError('c_name',    !name.value.trim());
  setError('c_email',   !email.value.trim() || !email.value.includes('@'));
  setError('c_reason',  !reason.value);
  setError('c_subject', !subject.value.trim());
  setError('c_message', !message.value.trim());

  if (valid) {
    const btn = document.querySelector('#contactForm .submit-btn');
    btn.textContent = '✓ Message Sent!';
    btn.style.background = 'var(--green-dark)';
    document.getElementById('contactForm').submit();
  }
}

/* ============================================
   4. DYNAMIC FEATURE 1 — Listings Search/Filter
============================================ */
function filterListings() {
  const input = document.getElementById('searchInput');
  if (!input) return;

  const query = input.value.toLowerCase().trim();
  const cards = document.querySelectorAll('#listingsGrid .listing-card');
  let found = 0;

  cards.forEach(function(card) {
    const title = card.querySelector('.listing-title');
    const tag   = card.querySelector('.listing-tag');
    const text  = ((title ? title.textContent : '') + ' ' + (tag ? tag.textContent : '')).toLowerCase();

    if (query === '' || text.includes(query)) {
      card.style.display = '';
      found++;
    } else {
      card.style.display = 'none';
    }
  });

  // Update result count
  const info = document.querySelector('.toolbar-info');
  if (info) {
    info.innerHTML = query
      ? 'Showing <strong>' + found + '</strong> result' + (found !== 1 ? 's' : '') + ' for "<strong>' + query + '</strong>"'
      : 'Showing <strong>1–9</strong> of <strong>701</strong> results';
  }
}

/* ============================================
   5. DYNAMIC FEATURE 2 — Gallery Fact Reveal
============================================ */
function revealFact(card) {
  const hidden = card.querySelector('.fact-hidden');
  const text   = card.querySelector('.fact-text');
  const title  = card.querySelector('h3');

  if (!hidden || !text) return;

  if (hidden.style.display !== 'none') {
    hidden.style.display = 'none';
    text.style.display = 'block';
    title.textContent = '📊 Did you know?';
    card.style.borderColor = 'var(--green)';
    card.style.background  = 'var(--green-light)';
  } else {
    hidden.style.display = '';
    text.style.display   = 'none';
    title.textContent    = 'Click to reveal';
    card.style.borderColor = '';
    card.style.background  = '';
  }
}

/* ============================================
   6. SEARCH — Enter key support
============================================ */
function setupSearchEnter() {
  const input = document.getElementById('searchInput');
  if (!input) return;
  input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') filterListings();
  });
}

/* ============================================
   7. ACTIVE NAV HIGHLIGHT
============================================ */
function setActiveNav() {
  const page = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-links a').forEach(function(link) {
    const href = link.getAttribute('href');
    if (href === page) link.classList.add('active');
  });
}

/* ============================================
   INIT — Run on page load
============================================ */
document.addEventListener('DOMContentLoaded', function() {
  showWelcomeMessage();
  setActiveNav();
  setupSearchEnter();

  // Attach form validators
  const registerForm = document.getElementById('registerForm');
  if (registerForm) registerForm.addEventListener('submit', validateRegisterForm);

  const contactForm = document.getElementById('contactForm');
  if (contactForm) contactForm.addEventListener('submit', validateContactForm);
});
