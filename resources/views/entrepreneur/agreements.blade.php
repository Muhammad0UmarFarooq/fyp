<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agreements Portal - InvestBridge</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen antialiased">

    <x-navbar />

    <div class="flex">
        <x-sidebar />

        <main class="flex-1 p-4 md:p-12">
            <div class="max-w-8xl mx-auto space-y-16">
                
                @if(session('success'))
                    <div class="bg-brand-green/20 border border-brand-green/30 text-brand-green px-6 py-4 rounded-xl flex items-center space-x-4 shadow-lg">
                        <span>✅</span>
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500/20 border border-red-500/30 text-red-400 px-6 py-4 rounded-xl flex items-center space-x-4 shadow-lg">
                        <span>❌</span>
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Section 1: Agreement Signature Page -->
                <div class="space-y-8">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Agreement Signature Page</h1>
                        <h2 class="text-xl font-semibold text-gray-300">Ready To Sign</h2>
                    </div>

                    <div class="space-y-6">
                        @forelse($readyToSign as $agreement)
                            <div class="bg-[#161e2d] border border-white/5 rounded-xl p-4 sm:p-6 shadow-xl space-y-6">
                                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                                    <div class="flex items-center space-x-4 min-w-0">
                                        <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 bg-gray-800 flex items-center justify-center font-bold text-lg text-brand-green flex-shrink-0">
                                            @if($agreement->investor->profile_image)
                                                <img src="{{ asset('storage/' . $agreement->investor->profile_image) }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($agreement->investor->name, 0, 2)) }}
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <span class="font-bold text-gray-200 text-base sm:text-lg block break-words">{{ $agreement->investor->name }}</span>
                                            <span class="text-xs text-gray-400">{{ $agreement->agreement_filename ?? 'Agreement Document' }} • {{ $agreement->agreement_filesize ?? '' }}</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-3 items-center">
                                        <button onclick="document.getElementById('reject-box-{{ $agreement->id }}').classList.toggle('hidden')" class="bg-red-600/20 border border-red-500/30 text-red-400 px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-red-600 hover:text-white transition-colors cursor-pointer shadow-lg">Reject</button>
                                        <a href="{{ route('entrepreneur.agreements.download', $agreement->id) }}" class="bg-[#1e293b] text-brand-green px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-brand-green hover:text-[#064e3b] transition-colors flex items-center space-x-2 shadow-lg">
                                            <span>📥</span>
                                            <span>Download Contract</span>
                                        </a>
                                        <button type="button" onclick="openSignatureModal('{{ route('entrepreneur.agreements.sign', $agreement->id) }}')" class="bg-brand-green text-[#064e3b] px-6 py-2.5 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-[#3dbd6d] transition-all cursor-pointer shadow-lg shadow-brand-green/10">
                                            Sign Agreement
                                        </button>
                                    </div>
                                </div>

                                <!-- Collapsible Reject Form -->
                                <div id="reject-box-{{ $agreement->id }}" class="hidden bg-[#0b1120] border border-red-500/30 rounded-xl p-6 mt-4 transition-all">
                                    <form action="{{ route('entrepreneur.agreements.reject', $agreement->id) }}" method="POST" class="space-y-4">
                                        @csrf
                                        <label class="text-xs font-bold text-red-400 uppercase tracking-widest block">Reason for Rejection</label>
                                        <textarea name="rejection_reason" required rows="3" placeholder="Explain why you are rejecting this agreement (e.g. return amount terms, time period)..." class="w-full bg-[#161e2d] border border-white/10 rounded-lg p-4 text-sm text-gray-200 focus:outline-none focus:border-red-500 transition-colors"></textarea>
                                        <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-4">
                                            <button type="button" onclick="document.getElementById('reject-box-{{ $agreement->id }}').classList.add('hidden')" class="px-6 py-2 rounded-lg text-xs font-bold text-gray-400 hover:text-white transition-colors">Cancel</button>
                                            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg text-xs font-bold uppercase tracking-wider hover:bg-red-700 transition-colors cursor-pointer shadow-lg">Submit Rejection</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="bg-[#161e2d]/50 border border-white/5 rounded-xl p-8 text-center text-gray-500 font-medium">
                                No new agreement documents received from investors.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 2: Active Agreements Portal -->
                <div class="space-y-8">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Agreements Portal</h1>
                        <p class="text-gray-400 text-sm leading-relaxed">Active and finalized legal agreements.</p>
                    </div>

                    <div class="space-y-4">
                        @forelse($active as $agreement)
                            <div class="bg-[#161e2d] border border-brand-green/30 rounded-xl p-6 flex justify-between items-center shadow-xl">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-[#0b1120] p-3 rounded-lg text-brand-green">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-200">{{ $agreement->agreement_filename ?? 'Signed_Agreement.pdf' }}</div>
                                        <div class="text-[10px] text-gray-500 font-bold uppercase">Investor: {{ $agreement->investor->name }} • Signed on {{ \Carbon\Carbon::parse($agreement->agreement_date)->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="bg-brand-green/10 text-brand-green px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider">Active</span>
                                    <a href="{{ route('entrepreneur.agreements.download', $agreement->id) }}" class="bg-[#1e293b] text-brand-green hover:bg-brand-green hover:text-[#064e3b] px-6 py-2.5 rounded-lg font-bold text-xs tracking-widest uppercase transition-all flex items-center space-x-2 shadow-lg">
                                        <span>📥</span>
                                        <span>Investor Contract</span>
                                    </a>
                                    @if($agreement->entrepreneur_file)
                                        <a href="{{ route('entrepreneur.agreements.download.entrepreneur', $agreement->id) }}" class="bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-[#0b1120] px-6 py-2.5 rounded-lg font-bold text-xs tracking-widest uppercase transition-all flex items-center space-x-2 shadow-lg">
                                            <span>📥</span>
                                            <span>Signed / Invoice</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="bg-[#161e2d]/30 border border-white/5 rounded-xl p-8 text-center text-gray-500 font-medium">
                                No finalized agreements yet.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 3: Rejected Agreements History -->
                @if($rejected->isNotEmpty())
                    <div class="space-y-6 pt-6">
                        <h2 class="text-xl font-bold text-gray-400">Rejected Agreements History</h2>
                        <div class="space-y-4">
                            @foreach($rejected as $agreement)
                                <div class="bg-[#161e2d]/50 border border-red-500/20 rounded-xl p-6 flex justify-between items-center opacity-80">
                                    <div class="flex items-center space-x-4">
                                        <div class="bg-red-500/10 p-3 rounded-lg text-red-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-300">Investor: {{ $agreement->investor->name }}</div>
                                            <div class="text-[10px] text-red-400 font-semibold mt-1">Reason: {{ $agreement->rejection_reason }}</div>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-gray-500 uppercase">Rejected {{ $agreement->updated_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </main>
    </div>

    <!-- Signature Modal -->
    <div id="signatureModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
        <div class="bg-[#161e2d] border border-white/10 rounded-3xl max-w-2xl w-full p-4 md:p-8 shadow-2xl space-y-6 relative">
            <div class="flex justify-between items-center border-b border-white/10 pb-4">
                <h3 class="text-2xl font-bold text-white flex items-center space-x-3">
                    <span>✍️</span>
                    <span>Create your signature</span>
                </h3>
                <button type="button" onclick="closeSignatureModal()" class="text-gray-400 hover:text-white text-2xl font-bold cursor-pointer">&times;</button>
            </div>

            <form id="signatureForm" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-sm font-bold text-gray-200">Signature</label>
                        <button type="button" onclick="clearSignature()" class="text-xs text-brand-green hover:underline">Clear</button>
                    </div>
                    
                    <div class="bg-white rounded-xl overflow-hidden border-2 border-dashed border-gray-300 relative h-64 w-full">
                        <canvas id="signatureCanvas" class="w-full h-full cursor-crosshair"></canvas>
                        <div id="signaturePlaceholder" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span class="text-gray-300 font-medium flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                <span>Draw signature</span>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="signature" id="signatureInput" required>
                </div>

                <div class="text-xs text-gray-500 font-medium leading-relaxed">
                    By creating this signature, I consent to its use as my electronic signature for any purpose, including legally binding documents.
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 border-t border-white/10 pt-6">
                    <button type="button" onclick="closeSignatureModal()" class="px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest bg-gray-800 text-gray-300 hover:bg-gray-700 transition-colors cursor-pointer">Cancel</button>
                    <button type="button" onclick="submitSignature()" class="bg-brand-green text-[#064e3b] px-10 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-[#3dbd6d] transition-colors shadow-lg shadow-brand-green/20 cursor-pointer">Create</button>
                </div>
            </form>
        </div>
    </div>

</body>
    <script>
        // Signature Pad Logic
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        const placeholder = document.getElementById('signaturePlaceholder');
        let isDrawing = false;
        let hasSignature = false;

        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            ctx.scale(ratio, ratio);
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.lineWidth = 3;
            ctx.strokeStyle = '#000000';
        }

        window.addEventListener('resize', resizeCanvas);

        function getMousePos(canvas, evt) {
            const rect = canvas.getBoundingClientRect();
            let clientX, clientY;

            if (evt.touches) {
                clientX = evt.touches[0].clientX;
                clientY = evt.touches[0].clientY;
            } else {
                clientX = evt.clientX;
                clientY = evt.clientY;
            }

            return {
                x: clientX - rect.left,
                y: clientY - rect.top
            };
        }

        function startDrawing(e) {
            isDrawing = true;
            hasSignature = true;
            placeholder.classList.add('hidden');
            const pos = getMousePos(canvas, e);
            ctx.beginPath();
            ctx.moveTo(pos.x, pos.y);
            e.preventDefault(); // Prevent scrolling on touch devices
        }

        function draw(e) {
            if (!isDrawing) return;
            const pos = getMousePos(canvas, e);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
            e.preventDefault();
        }

        function stopDrawing() {
            if (isDrawing) {
                isDrawing = false;
                ctx.closePath();
            }
        }

        // Mouse events
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        // Touch events
        canvas.addEventListener('touchstart', startDrawing, { passive: false });
        canvas.addEventListener('touchmove', draw, { passive: false });
        canvas.addEventListener('touchend', stopDrawing);
        canvas.addEventListener('touchcancel', stopDrawing);

        function clearSignature() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            hasSignature = false;
            placeholder.classList.remove('hidden');
        }

        function openSignatureModal(actionUrl) {
            const modal = document.getElementById('signatureModal');
            const form = document.getElementById('signatureForm');
            form.action = actionUrl;
            modal.classList.remove('hidden');
            
            // Need to wait for modal to be visible before resizing canvas correctly
            setTimeout(() => {
                resizeCanvas();
                clearSignature();
            }, 50);
        }

        function closeSignatureModal() {
            document.getElementById('signatureModal').classList.add('hidden');
            clearSignature();
        }

        function submitSignature() {
            if (!hasSignature) {
                alert('Please provide a signature before submitting.');
                return;
            }

            // Create a temporary canvas to save with a white background instead of transparent
            const tempCanvas = document.createElement('canvas');
            const tempCtx = tempCanvas.getContext('2d');
            tempCanvas.width = canvas.width;
            tempCanvas.height = canvas.height;
            
            // Fill white background
            tempCtx.fillStyle = '#ffffff';
            tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
            
            // Draw signature on top
            tempCtx.drawImage(canvas, 0, 0);

            const dataUrl = tempCanvas.toDataURL('image/png');
            document.getElementById('signatureInput').value = dataUrl;
            document.getElementById('signatureForm').submit();
        }
    </script>
</html>
