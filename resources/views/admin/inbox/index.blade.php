<x-admin.layout>
    <x-slot name="inbox_css">
        <link rel="stylesheet" href="{{ asset('css/admin/inbox.css') }}">
    </x-slot name="inbox_css">
    <div class="container-fluid">
        <div class="inbox-container">
            <!-- Header -->
            <div class="header">
                <div class="inbox-title">صندوق الوارد</div>
            </div>

            <!-- Main Content -->
            <div class="inbox-content">
                <!-- Message List -->
                <div class="message-list">

                    <!-- Message Item (Active) -->
                    <div class="message-item active">
                        <img src="/api/placeholder/50/50" class="avatar" alt="صورة المرسل">
                        <div class="message-content">
                            <div class="message-sender">سارة أحمد</div>
                            <div class="message-status">قبل 3 دقائق</div>
                            <div class="message-preview">استفسار عن موعد المتابعة القادم...</div>
                        </div>
                        <div class="message-badge">12</div>
                    </div>

                    <!-- Message Item -->
                    <div class="message-item">
                        <img src="/api/placeholder/50/50" class="avatar" alt="صورة المرسل">
                        <div class="message-content">
                            <div class="message-sender">محمد خالد</div>
                            <div class="message-status">أمس</div>
                            <div class="message-preview">شكراً على المتابعة السريعة للحالة...</div>
                        </div>
                    </div>

                    <!-- Message Item -->
                    <div class="message-item">
                        <img src="/api/placeholder/50/50" class="avatar" alt="صورة المرسل">
                        <div class="message-content">
                            <div class="message-sender">فاطمة علي</div>
                            <div class="message-status">12 مارس</div>
                            <div class="message-preview">هل يمكن تغيير موعد الزيارة القادمة...</div>
                        </div>
                    </div>
                </div>

                <!-- Message Details -->
                <div class="message-details">
                    <div class="message-header">
                        <div class="sender-info">
                            <img src="/api/placeholder/60/60" class="sender-avatar" alt="صورة المرسل">
                            <div>
                                <div class="sender-name">سارة أحمد</div>
                                <div class="message-status">قبل 3 دقائق</div>
                            </div>
                        </div>
                    </div>

                    <div class="message-body">
                        <p class="message-text">استفسار عن موعد المتابعة القادم...</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
