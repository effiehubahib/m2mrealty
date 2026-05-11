@extends('layouts.app')
@section('title') Contact Us — M2M Realty & Brokerage @endsection
@section('content')

{{-- ============================================================
     CONTACT PAGE
     ============================================================ --}}

{{-- ── HERO BANNER ─────────────────────────────────────────── --}}
<div class="relative bg-slate-900 overflow-hidden">
  {{-- Background image overlay --}}
  <div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=1600&q=80"
         alt="Office"
         class="w-full h-full object-cover opacity-25" />
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-transparent"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
    <p class="text-cyan-400 text-xs font-bold tracking-[0.2em] uppercase mb-3">Get In Touch</p>
    <h1 class="text-4xl lg:text-5xl font-bold text-white leading-tight max-w-xl">
      Let's Find Your<br/>
      <span class="text-cyan-400">Perfect Property</span>
    </h1>
    <p class="text-slate-300 mt-4 text-sm leading-relaxed max-w-md">
      Whether you're buying, selling, or investing — our team of experts is ready
      to guide you through every step of the process.
    </p>

    {{-- Quick stats --}}
    <div class="flex flex-wrap gap-8 mt-10">
      @foreach ([['500+', 'Properties Sold'], ['15+', 'Years Experience'], ['98%', 'Client Satisfaction']] as $stat)
      <div>
        <p class="text-2xl font-bold text-white">{{ $stat[0] }}</p>
        <p class="text-xs text-slate-400 mt-0.5">{{ $stat[1] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</div>


{{-- ── MAIN CONTENT ─────────────────────────────────────────── --}}
<section class="bg-slate-100 py-14">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">


      {{-- ======================================================
           LEFT — CONTACT INFO CARDS
           ====================================================== --}}
      <div class="space-y-5">

        {{-- Office card --}}
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center shrink-0">
              <svg class="h-5 w-5 text-cyan-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
              </svg>
            </div>
            <div>
              <h3 class="text-sm font-bold text-slate-900 mb-1">Our Office</h3>
              <p class="text-sm text-slate-500 leading-relaxed">
                88 Luxury Tower, BGC<br/>
                Taguig City, Metro Manila<br/>
                Philippines 1634
              </p>
            </div>
          </div>
        </div>

        {{-- Phone card --}}
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center shrink-0">
              <svg class="h-5 w-5 text-cyan-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l.9-.9a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-sm font-bold text-slate-900 mb-1">Phone</h3>
              <a href="tel:+6328555001" class="text-sm text-slate-500 hover:text-cyan-600 transition-colors block">+63 (2) 8555-0001</a>
              <a href="tel:+6328555002" class="text-sm text-slate-500 hover:text-cyan-600 transition-colors block mt-0.5">+63 (2) 8555-0002</a>
            </div>
          </div>
        </div>

        {{-- Email card --}}
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center shrink-0">
              <svg class="h-5 w-5 text-cyan-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/>
              </svg>
            </div>
            <div>
              <h3 class="text-sm font-bold text-slate-900 mb-1">Email</h3>
              <a href="mailto:hello@m2mrealty.com" class="text-sm text-slate-500 hover:text-cyan-600 transition-colors block">hello@m2mrealty.com</a>
              <a href="mailto:listings@m2mrealty.com" class="text-sm text-slate-500 hover:text-cyan-600 transition-colors block mt-0.5">listings@m2mrealty.com</a>
            </div>
          </div>
        </div>

        {{-- Hours card --}}
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center shrink-0">
              <svg class="h-5 w-5 text-cyan-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
              </svg>
            </div>
            <div class="w-full">
              <h3 class="text-sm font-bold text-slate-900 mb-2">Office Hours</h3>
              <div class="space-y-1">
                @foreach ([
                  ['Mon – Fri', '8:00 AM – 6:00 PM'],
                  ['Saturday',  '9:00 AM – 4:00 PM'],
                  ['Sunday',    'By Appointment'],
                ] as $hours)
                <div class="flex justify-between text-sm">
                  <span class="text-slate-500">{{ $hours[0] }}</span>
                  <span class="text-slate-700 font-medium">{{ $hours[1] }}</span>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        {{-- Social links --}}
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
          <h3 class="text-sm font-bold text-slate-900 mb-4">Follow Us</h3>
          <div class="flex items-center gap-3">
            @foreach ([
              ['Facebook',  'M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z'],
              ['Instagram', 'M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z M17.5 6.5h.01 M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2z'],
              ['LinkedIn',  'M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z M2 9h4v12H2z M4 6a2 2 0 1 0 0-4 2 2 0 0 0 0 4z'],
            ] as $social)
            <a href="#" aria-label="{{ $social[0] }}"
               class="w-9 h-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:border-cyan-400 hover:text-cyan-600 transition-colors">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="{{ $social[1] }}"/>
              </svg>
            </a>
            @endforeach
          </div>
        </div>

      </div>


      {{-- ======================================================
           RIGHT — CONTACT FORM (spans 2 cols)
           ====================================================== --}}
      <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl p-8 shadow-sm">

        <h2 class="text-2xl font-bold text-slate-900 mb-1">Send Us a Message</h2>
        <p class="text-sm text-slate-500 mb-8">Fill out the form and one of our agents will get back to you within 24 hours.</p>

        {{-- Session success message --}}
        @if (session('success'))
        <div class="flex items-center gap-3 bg-cyan-50 border border-cyan-200 text-cyan-700 rounded-lg px-4 py-3 mb-6 text-sm">
          <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
          {{ session('success') }}
        </div>
        @endif

        <form action="#" method="POST" class="space-y-5" id="contact-form">
            {{-- {{ route('contact.send') }} --}}
          @csrf

          {{-- Name row --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-1.5" for="first_name">First Name <span class="text-red-400">*</span></label>
              <input type="text" id="first_name" name="first_name" required
                     value="{{ old('first_name') }}"
                     placeholder="Juan"
                     class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors @error('first_name') border-red-400 @enderror" />
              @error('first_name')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-1.5" for="last_name">Last Name <span class="text-red-400">*</span></label>
              <input type="text" id="last_name" name="last_name" required
                     value="{{ old('last_name') }}"
                     placeholder="Dela Cruz"
                     class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors @error('last_name') border-red-400 @enderror" />
              @error('last_name')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          {{-- Email + Phone row --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-1.5" for="email">Email Address <span class="text-red-400">*</span></label>
              <input type="email" id="email" name="email" required
                     value="{{ old('email') }}"
                     placeholder="juan@example.com"
                     class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors @error('email') border-red-400 @enderror" />
              @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-1.5" for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone"
                     value="{{ old('phone') }}"
                     placeholder="+63 9XX XXX XXXX"
                     class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors" />
            </div>
          </div>

          {{-- Inquiry type --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5" for="inquiry_type">Inquiry Type <span class="text-red-400">*</span></label>
            <div class="relative">
              <select id="inquiry_type" name="inquiry_type" required
                      class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-lg pl-4 pr-9 py-2.5 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors cursor-pointer @error('inquiry_type') border-red-400 @enderror">
                <option value="" disabled {{ old('inquiry_type') ? '' : 'selected' }}>Select inquiry type…</option>
                @foreach (['Buying a Property', 'Selling a Property', 'Renting / Leasing', 'Investment Inquiry', 'Property Valuation', 'General Question'] as $type)
                  <option value="{{ $type }}" {{ old('inquiry_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
              </select>
              <svg class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"/>
              </svg>
            </div>
            @error('inquiry_type')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Budget / property interest --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5" for="budget">Budget Range</label>
            <div class="relative">
              <select id="budget" name="budget"
                      class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-lg pl-4 pr-9 py-2.5 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors cursor-pointer">
                <option value="" disabled {{ old('budget') ? '' : 'selected' }}>Select a budget range…</option>
                @foreach ([
                  'Under ₱1,000,000',
                  '₱1,000,000 – ₱3,000,000',
                  '₱3,000,000 – ₱5,000,000',
                  '₱5,000,000 – ₱10,000,000',
                  'Above ₱10,000,000',
                ] as $range)
                  <option value="{{ $range }}" {{ old('budget') === $range ? 'selected' : '' }}>{{ $range }}</option>
                @endforeach
              </select>
              <svg class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"/>
              </svg>
            </div>
          </div>

          {{-- Message --}}
          <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5" for="message">Message <span class="text-red-400">*</span></label>
            <textarea id="message" name="message" required rows="5"
                      placeholder="Tell us more about what you're looking for…"
                      class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-cyan-400 transition-colors resize-none @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
            @error('message')
              <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Preferred contact method --}}
          <div>
            <p class="text-xs font-semibold text-slate-700 mb-2">Preferred Contact Method</p>
            <div class="flex flex-wrap gap-4">
              @foreach (['Email', 'Phone', 'Either'] as $method)
              <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="contact_method" value="{{ strtolower($method) }}"
                       {{ old('contact_method', 'email') === strtolower($method) ? 'checked' : '' }}
                       class="w-4 h-4 accent-cyan-600" />
                <span class="text-sm text-slate-600">{{ $method }}</span>
              </label>
              @endforeach
            </div>
          </div>

          {{-- Submit --}}
          <div class="pt-2">
            <button type="submit" id="submit-btn"
                    class="w-full bg-cyan-700 hover:bg-cyan-800 text-white font-semibold text-sm py-3.5 rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2">
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
              </svg>
              Send Message
            </button>
            <p class="text-center text-xs text-slate-400 mt-3">We typically respond within 24 business hours.</p>
          </div>

        </form>
      </div>

    </div>


    {{-- ======================================================
         MAP SECTION
         ====================================================== --}}
    <div class="mt-8 bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
      <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
        <div>
          <h3 class="text-base font-bold text-slate-900">Find Us</h3>
          <p class="text-xs text-slate-500 mt-0.5">88 Luxury Tower, BGC, Taguig City, Metro Manila</p>
        </div>
        <a href="https://maps.google.com/?q=BGC+Taguig+Manila" target="_blank" rel="noopener noreferrer"
           class="flex items-center gap-1.5 text-xs font-medium text-cyan-600 hover:text-cyan-700 transition-colors">
          Open in Maps
          <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
          </svg>
        </a>
      </div>
      {{-- Embedded Google Map — replace src with your real embed URL --}}
      <div class="h-72 bg-slate-100 relative">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.819!2d121.0437!3d14.5547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c90264d745d3%3A0xc6b50a9f6f25c42!2sBGC%2C%20Taguig%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1"
          width="100%" height="100%"
          style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="M2M Realty Office Location">
        </iframe>
      </div>
    </div>

  </div>
</section>


{{-- ============================================================
     CONTACT FORM JS — loading state on submit
     ============================================================ --}}
<script>
(function () {
  const form      = document.getElementById('contact-form');
  const submitBtn = document.getElementById('submit-btn');

  if (!form || !submitBtn) return;

  form.addEventListener('submit', function () {
    submitBtn.disabled   = true;
    submitBtn.innerHTML  =
      '<svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Sending…';
  });
})();
</script>

@endsection