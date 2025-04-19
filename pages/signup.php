<?php
    require "../header.php";
?>
<style>
.form-grid {
    display: grid;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-field {
    position: relative;
}

.input-group {
    position: relative;
    display: flex;
    align-items: center;
    background: var(--light);
    border-radius: var(--radius);
    border: 1px solid var(--light-gray);
    transition: var(--transition);
    height: 56px;
}

.input-group:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(80, 200, 120, 0.2);
}

.input-icon {
    padding: 0 1rem;
    color: var(--gray);
    display: flex;
    align-items: center;
    font-size: 1rem;
}

.form-input {
    flex: 1;
    padding: 1rem 1rem 1rem 0;
    border: none;
    background: transparent;
    font-size: 1rem;
    outline: none;
    height: 100%;
}

.floating-label {
    position: absolute;
    left: 3.5rem;
    top: 1rem;
    color: var(--gray);
    background: var(--light);
    padding: 0 0.25rem;
    transition: var(--transition);
    pointer-events: none;
    font-size: 1rem;
}

.form-input:focus + .floating-label,
.form-input:not(:placeholder-shown) + .floating-label {
    top: -0.6rem;
    left: 1rem;
    font-size: 0.75rem;
    color: var(--primary);
    background: linear-gradient(to bottom, var(--light) 50%, transparent 50%);
    padding: 0 0.5rem;
}

.password-toggle {
    background: none;
    border: none;
    padding: 0 1rem;
    color: var(--gray);
    cursor: pointer;
    font-size: 1rem;
}

.password-strength {
    margin-top: 0.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.strength-bar {
    height: 4px;
    width: 0;
    background: var(--error);
    border-radius: 2px;
    transition: var(--transition);
}

.strength-text {
    font-size: 0.75rem;
    color: var(--gray);
}

.input-hint {
    font-size: 0.75rem;
    color: var(--gray);
    margin-top: 0.25rem;
    padding-left: 3.5rem;
}

/* Form Actions */
.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

.auth-divider {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--gray);
    margin: 0.5rem 0;
}

.divider-line {
    flex: 1;
    height: 1px;
    background: var(--light-gray);
}

.divider-text {
    font-size: 0.875rem;
}

.auth-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: var(--dark);
    font-size: 0.9rem;
    transition: var(--transition);
    padding: 0.75rem;
    border-radius: var(--radius);
    border: 1px solid var(--light-gray);
}

.auth-link:hover {
    color: var(--primary);
    border-color: var(--primary-light);
    background: rgba(80, 200, 120, 0.05);
}

/* Tombol Submit */
.auth-button {
    padding: 1rem;
    border-radius: var(--radius);
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    box-shadow: var(--shadow);
}

.auth-button:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    background: linear-gradient(135deg, var(--primary-dark), var(--primary));
}

.button-icon {
    font-size: 1rem;
}
</style>
    <main>
        <div class="wrapper-main">
            <div class="auth-container">
                <section class="auth-card">
                    <div class="auth-header">
                        <h1 class="auth-title">Daftar Akun Baru</h1>
                        <div class="islamic-decoration">    
                        </div>
                    </div>
                    
                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyFields") {
                                echo '<div class="auth-message error"><i class="fas fa-exclamation-circle"></i> Harap isi semua field!</div>';
                            }
                            elseif ($_GET["error"] == "invalidMailUid") {
                                echo '<div class="auth-message error"><i class="fas fa-exclamation-circle"></i> Username dan email tidak valid!</div>';
                            }
                            elseif ($_GET["error"] == "invalidUid") {
                                echo '<div class="auth-message error"><i class="fas fa-exclamation-circle"></i> Username tidak valid!</div>';
                            }
                            elseif ($_GET["error"] == "invalidMail") {
                                echo '<div class="auth-message error"><i class="fas fa-exclamation-circle"></i> Email tidak valid!</div>';
                            }
                            elseif ($_GET["error"] == "passwordCheck") {
                                echo '<div class="auth-message error"><i class="fas fa-exclamation-circle"></i> Password tidak cocok!</div>';
                            }
                            elseif ($_GET["error"] == "userTaken") {
                                echo '<div class="auth-message error"><i class="fas fa-exclamation-circle"></i> Username sudah digunakan!</div>';
                            }
                        }
                        elseif (isset($_GET["signup"])) {
                            if ($_GET["signup"] == "success") {
                                echo '<div class="auth-message success"><i class="fas fa-check-circle"></i> Pendaftaran berhasil!</div>';
                            }
                        }
                    ?>
                    
                    <form class="auth-form" action="../includes/signup.inc.php" method="post">
                        <div class="form-grid">
                            <!-- Username Field -->
                            <div class="form-field">
                                <div class="input-group">
                                    <span class="input-icon">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        id="uid" 
                                        name="uid" 
                                        placeholder=" " 
                                        class="form-input"
                                        autocomplete="username"
                                        required
                                    >
                                    <label for="uid" class="floating-label">Username</label>
                                </div>
                                <p class="input-hint">Minimal 6 karakter, kombinasi huruf dan angka</p>
                            </div>

                            <!-- Email Field -->
                            <div class="form-field">
                                <div class="input-group">
                                    <span class="input-icon">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input 
                                        type="email" 
                                        id="mail" 
                                        name="mail" 
                                        placeholder=" " 
                                        class="form-input"
                                        autocomplete="email"
                                        required
                                    >
                                    <label for="mail" class="floating-label">Alamat Email</label>
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="form-field">
                                <div class="input-group">
                                    <span class="input-icon">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input 
                                        type="password" 
                                        id="pwd" 
                                        name="pwd" 
                                        placeholder=" " 
                                        class="form-input"
                                        autocomplete="new-password"
                                        required
                                    >
                                    <label for="pwd" class="floating-label">Password</label>
                                    <button type="button" class="password-toggle">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength">
                                    <div class="strength-bar"></div>
                                    <span class="strength-text">Kekuatan password: <span class="strength-status">-</span></span>
                                </div>
                            </div>

                            <!-- Repeat Password Field -->
                            <div class="form-field">
                                <div class="input-group">
                                    <span class="input-icon">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input 
                                        type="password" 
                                        id="pwd-repeat" 
                                        name="pwd-repeat" 
                                        placeholder=" " 
                                        class="form-input"
                                        autocomplete="new-password"
                                        required
                                    >
                                    <label for="pwd-repeat" class="floating-label">Ulangi Password</label>
                                </div>
                                <p class="input-hint">Harus sama dengan password di atas</p>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" name="signup-submit" class="auth-button">
                                <i class="fas fa-user-plus button-icon"></i>
                                <span>Daftar Sekarang</span>
                            </button>
                            
                            <div class="auth-divider">
                                <span class="divider-line"></span>
                                <span class="divider-text">atau</span>
                                <span class="divider-line"></span>
                            </div>
                            
                            <a href="login.php" class="auth-link">
                                <i class="fas fa-sign-in-alt"></i>
                                Masuk dengan akun yang ada
                            </a>
                        </div>
                    </form>
                    
                    <div class="auth-footer">
                        <p>Dengan mendaftar, Anda menyetujui <a href="#">Syarat & Ketentuan</a> kami</p>
                    </div>
                </section>
                
                <div class="auth-decoration">
                    <div class="decoration-content">
                        <h3 class="decoration-title">Bersihkan Harta dengan Zakat</h3>
                        <p class="arabic-text">وَزَكَاةَ أَمْوَالِهِمْ</p>
                        <div class="arabesque-pattern"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    // Password Toggle Functionality
    document.querySelectorAll('.password-toggle').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye-slash');
        });
    });

    // Password Strength Indicator
    const passwordInput = document.getElementById('pwd');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.querySelector('.strength-bar');
            const strengthStatus = document.querySelector('.strength-status');
            let strength = 0;
            
            // Check criteria
            if (password.length > 0) strength += 1;
            if (password.length >= 8) strength += 1;
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;

            // Update UI
            const width = strength * 20;
            strengthBar.style.width = width + '%';
            
            if (strength <= 2) {
                strengthBar.style.backgroundColor = '#FF385C';
                strengthStatus.textContent = 'Lemah';
            } else if (strength <= 4) {
                strengthBar.style.backgroundColor = '#D4AF37';
                strengthStatus.textContent = 'Sedang';
            } else {
                strengthBar.style.backgroundColor = '#50C878';
                strengthStatus.textContent = 'Kuat';
            }
        });
    }
    </script>

<?php
    require "../footer.php";
?>