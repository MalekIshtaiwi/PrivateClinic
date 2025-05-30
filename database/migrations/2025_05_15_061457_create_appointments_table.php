    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('appointments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
                $table->date('date');
                $table->time('time');
                $table->enum('status',['booked','cancelled','done'])->default('booked');
                $table->enum('visit_type',['first','return']);
                $table->timestamps();

                $table->unique(['patient_id','date']);
                $table->unique(['date','time']);
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('appointments');
        }
    };
