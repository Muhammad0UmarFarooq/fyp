<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Your Pitch - InvestBridge</title>
    
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

        <main class="flex-1 p-12">
            <div class="max-w-8xl mx-auto">
                <!-- Header -->
                <div class="mb-12">
                    <h1 class="text-4xl font-bold mb-4">Create Your Pitch</h1>
                    <p class="text-gray-400 text-sm max-w-2xl leading-relaxed">
                        Transform your vision into an institutional-grade investment opportunity. Complete the following dimensions of your venture.
                    </p>
                </div>

                <form method="POST" action="{{ route('entrepreneur.pitch.store') }}" enctype="multipart/form-data" class="space-y-16">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-4 rounded-xl">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- 01. Video Transmission -->
                    <div class="space-y-6">
                        <div class="flex justify-between items-end">
                            <h2 class="text-brand-yellow font-bold tracking-[0.2em] text-sm">01. VIDEO TRANSMISSION</h2>
                            <span class="text-[10px] text-gray-500 font-bold uppercase">MAX 2,500 MB - MP4/MOV</span>
                        </div>
                        
                        <div id="drop-zone" class="relative w-full aspect-video bg-[#111625] rounded-xl overflow-hidden border border-white/5 group cursor-pointer transition-colors duration-300" onclick="document.getElementById('video-upload').click()">
                            <input type="file" name="video" id="video-upload" accept="video/mp4,video/quicktime" class="hidden" onchange="handleFileSelect(event)">
                            <img id="placeholder-img" src="{{ asset('images/shoes_shop.jpg') }}" class="w-full h-full object-cover opacity-40 group-hover:opacity-50 transition-opacity">
                            <video id="video-preview" class="hidden w-full h-full object-cover z-10 relative" controls></video>
                            
                            <div id="upload-overlay" class="absolute inset-0 flex flex-col items-center justify-center space-y-4 pointer-events-none z-20">
                                <div class="bg-brand-green/20 p-4 rounded-xl border border-brand-green/30 transition-transform group-hover:scale-110 duration-300">
                                    <svg class="w-6 h-6 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                </div>
                                <span id="upload-text" class="text-sm font-medium text-gray-300">Drop your executive pitch here or click to browse</span>
                            </div>
                        </div>
                    </div>

                    <!-- 02. Pitches Identity -->
                    <div class="space-y-8">
                        <h2 class="text-[#facc15] font-bold tracking-[0.2em] text-sm uppercase">02. Pitches Identity</h2>
                        
                        <div id="pitch-identity-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Startup Name</label>
                                <input type="text" name="startup_name" placeholder="Enter your startup name" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-sm" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Invested Amount (Owner Investment)</label>
                                <input type="text" name="invested_amount" placeholder="e.g. PKR 5,000,000" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Monthly Net Value(Total Revenue - Total Expenses )</label>
                                <input type="text" name="monthly_net_value" placeholder="e.g. PKR 1,000,000" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-sm">
                            </div>
                            <div id="monthly-growth-field" class="space-y-2">
                                <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Monthly Growth</label>
                                <div class="flex items-center bg-[#0b1120] border border-white/5 rounded">
                                    <input type="text" name="monthly_growth" placeholder="e.g. 22%" class="flex-1 bg-transparent px-4 py-4 focus:outline-none text-sm">
                                    <div class="p-2">
                                        <button type="button" onclick="removeFinalField('monthly-growth-field')" class="bg-white w-8 h-8 flex items-center justify-center rounded shadow-sm group">
                                            <div class="bg-[#ff0000] w-6 h-6 rounded-full flex items-center justify-center group-hover:bg-[#b30000] transition-colors">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Add Button Box (Always at the end) -->
                            <div id="add-button-box" class="bg-[#0b1120] border border-white/5 h-[84px] rounded flex items-center justify-center">
                                <button type="button" onclick="showFieldCreator()" class="bg-white w-10 h-10 flex items-center justify-center rounded shadow-sm group">
                                    <div class="bg-[#007bff] w-8 h-8 rounded-full flex items-center justify-center group-hover:bg-[#0056b3] transition-colors">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                            <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Vision Statement</label>
                            <textarea name="vision_statement" rows="4" placeholder="Describe your vision for the future of this venture..." class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-3 focus:outline-none focus:border-brand-green/50 text-sm leading-relaxed"></textarea>
                        </div>
                    </div>

                    <!-- 03. The Capital Architecture -->
                    <div class="bg-[#111625] border border-white/5 p-8 rounded-2xl space-y-8">
                        <h2 class="text-brand-yellow font-bold tracking-[0.2em] text-sm">03. THE CAPITAL ARCHITECTURE</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Funding Amount Required (PKR)</label>
                                    <input type="text" name="funding_required" placeholder="e.g. PKR 5,000,000" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-lg font-bold">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Return Time (Period)</label>
                                    <input type="text" name="return_time" placeholder="e.g. 2 years" class="w-full bg-[#0b1120] border border-white/5 rounded px-4 py-4 focus:outline-none focus:border-brand-green/50 text-lg font-bold">
                                </div>
                            </div>

                            <div class="bg-[#0b1120] p-10 rounded-xl border border-white/5 text-center">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 block">Total Valuation</label>
                                <div class="flex items-center justify-center space-x-2">
                                    <span class="text-5xl font-bold text-brand-green">PKR</span>
                                    <input type="text" name="total_valuation" placeholder="10,000,000" class="bg-transparent text-5xl font-bold text-brand-green focus:outline-none w-full text-center">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Publish Button -->
                    <div class="flex justify-center pb-12">
                        <button type="submit" class="bg-[#4ade80] text-[#064e3b] px-16 py-4 rounded font-bold text-sm tracking-widest uppercase hover:bg-[#3dbd6d] transition-all shadow-xl shadow-brand-green/10">
                            Publish Pitch
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        let fieldCount = 0;
        
        function showFieldCreator() {
            fieldCount++;
            const grid = document.getElementById('pitch-identity-grid');
            const addButtonBox = document.getElementById('add-button-box');
            const creatorId = `creator-${fieldCount}`;
            
            const creatorHTML = `
                <div id="${creatorId}" class="bg-[#0b1120] border border-white/10 p-4 rounded space-y-3">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Title</label>
                        <input type="text" id="title-${fieldCount}" class="w-full bg-[#111625] border border-white/5 rounded px-3 py-2 text-xs text-gray-300 focus:outline-none" placeholder="e.g. Target Market">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">Field</label>
                        <input type="text" id="value-${fieldCount}" class="w-full bg-[#111625] border border-white/5 rounded px-3 py-2 text-xs text-gray-300 focus:outline-none" placeholder="e.g. Global">
                    </div>
                    <div class="flex items-center space-x-2 pt-1">
                        <button type="button" onclick="removeCreator('${creatorId}')" class="bg-[#ff0000] text-white text-[10px] font-bold px-3 py-1.5 rounded uppercase tracking-wider hover:bg-red-700 transition-colors">Remove</button>
                        <button type="button" onclick="addField(${fieldCount})" class="bg-[#007bff] text-white text-[10px] font-bold px-4 py-1.5 rounded uppercase tracking-wider hover:bg-[#0056b3] transition-colors">ADD</button>
                    </div>
                </div>
            `;
            
            // Insert before the add button box
            addButtonBox.insertAdjacentHTML('beforebegin', creatorHTML);
        }

        function addField(id) {
            const titleInput = document.getElementById(`title-${id}`);
            const valueInput = document.getElementById(`value-${id}`);
            const title = titleInput.value || 'Additional Info';
            const value = valueInput.value || '';
            const creator = document.getElementById(`creator-${id}`);
            const addButtonBox = document.getElementById('add-button-box');
            
            const fieldId = `field-final-${id}`;
            const fieldHTML = `
                <div id="${fieldId}" class="space-y-2">
                    <label class="text-[10px] font-bold text-[#475569] uppercase tracking-widest">${title}</label>
                    <div class="flex items-center bg-[#0b1120] border border-white/5 rounded">
                        <input type="hidden" name="custom_fields[${id}][label]" value="${title}">
                        <input type="text" name="custom_fields[${id}][value]" value="${value}" class="flex-1 bg-transparent px-4 py-4 focus:outline-none text-sm">
                        <div class="p-2">
                            <button type="button" onclick="removeFinalField('${fieldId}')" class="bg-white w-8 h-8 flex items-center justify-center rounded shadow-sm group">
                                <div class="bg-[#ff0000] w-6 h-6 rounded-full flex items-center justify-center group-hover:bg-[#b30000] transition-colors">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Remove the creator box
            creator.remove();
            
            // Insert the permanent field before the add button box
            addButtonBox.insertAdjacentHTML('beforebegin', fieldHTML);
        }
        
        function removeCreator(id) {
            document.getElementById(id).remove();
        }

        function removeFinalField(id) {
            document.getElementById(id).remove();
            // Also if they delete the monthly growth field
            if(id === 'monthly-growth-field') {
                const mgf = document.getElementById('monthly-growth-field');
                if(mgf) mgf.remove();
            }
        }

        // Video Drag and Drop functionality
        const dropZone = document.getElementById('drop-zone');
        const videoUpload = document.getElementById('video-upload');
        const videoPreview = document.getElementById('video-preview');
        const placeholderImg = document.getElementById('placeholder-img');
        const uploadOverlay = document.getElementById('upload-overlay');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-brand-green');
            dropZone.classList.replace('bg-[#111625]', 'bg-[#1a2235]');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-brand-green');
            dropZone.classList.replace('bg-[#1a2235]', 'bg-[#111625]');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        function handleFileSelect(e) {
            const files = e.target.files;
            handleFiles(files);
        }

        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                if (file.type === 'video/mp4' || file.type === 'video/quicktime') {
                    if (file.size <= 2500 * 1024 * 1024) { // 2,500 MB limit
                        const fileURL = URL.createObjectURL(file);
                        videoPreview.src = fileURL;
                        videoPreview.classList.remove('hidden');
                        placeholderImg.classList.add('hidden');
                        uploadOverlay.classList.add('hidden');
                        
                        if (videoUpload.files !== files) {
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            videoUpload.files = dataTransfer.files;
                        }
                    } else {
                        alert('File size exceeds the 2,500 MB limit.');
                    }
                } else {
                    alert('Please upload an MP4 or MOV file.');
                }
            }
        }

        videoPreview.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>

</body>
</html>
