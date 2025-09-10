<?php
// index.php - Modern Voice Typing App with Enhanced Features
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoiceNote Pro - Modern Voice Typing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #0ea5e9;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --sidebar-bg: #ffffff;
            --sidebar-border: #e2e8f0;
            --content-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-light: #94a3b8;
            --gradient-start: #8b5cf6;
            --gradient-end: #6366f1;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            /* Highlight Color */
            --highlight-bg: #fff3cd;
            --highlight-border: #ffeaa7;
        }
        body.dark {
            --sidebar-bg: #1e293b;
            --sidebar-border: #334155;
            --content-bg: #0f172a;
            --card-bg: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-light: #64748b;
            /* Dark mode highlight */
            --highlight-bg: #332701;
            --highlight-border: #55450a;
            /* Dark mode timer colors */
            --timer-text: #cbd5e1;
            --timer-bg: rgba(255, 255, 255, 0.1);
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--content-bg);
            color: var(--text-primary);
            min-height: 100vh;
            transition: all 0.3s ease;
            font-size: 1rem;
            line-height: 1.6;
        }
        /* Top Navigation */
        .top-nav {
            background: var(--sidebar-bg);
            border-bottom: 1px solid var(--sidebar-border);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 70px;
            box-shadow: var(--shadow);
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .logo-icon {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }
        .logo-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .theme-toggle {
            background: var(--card-bg);
            border: 1px solid var(--sidebar-border);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-secondary);
        }
        .theme-toggle:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        /* Main Layout */
        .main-layout {
            display: flex;
            min-height: calc(100vh - 70px);
            margin-top: 70px;
        }
        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            padding: 25px 20px;
            position: fixed;
            left: 0;
            top: 70px;
            height: calc(100vh - 70px);
            overflow-y: auto;
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }
        .sidebar-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--sidebar-border);
        }
        .sidebar-header h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.3rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-menu {
            list-style: none;
            flex: 1;
        }
        .nav-item {
            margin-bottom: 8px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            text-decoration: none;
            color: var(--text-secondary);
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 1rem;
        }
        .nav-link:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }
        .nav-link.active {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
        }
        .nav-link i {
            width: 20px;
            text-align: center;
        }
        .sidebar-footer {
            margin-top: auto;
            padding-top: 25px;
            border-top: 1px solid var(--sidebar-border);
        }
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 35px;
            min-height: calc(100vh - 70px);
        }
        .section {
            display: none;
        }
        .section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-header {
            margin-bottom: 35px;
            text-align: center;
        }
        .page-header h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 12px;
            color: var(--text-primary);
        }
        .page-header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        /* Voice Typing Card */
        .voice-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 35px;
            border: 1px solid var(--sidebar-border);
            box-shadow: var(--shadow);
            margin-bottom: 35px;
        }
        .card-header {
            margin-bottom: 30px;
        }
        .card-header h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.8rem;
            color: var(--text-primary);
            margin-bottom: 10px;
        }
        .card-header p {
            color: var(--text-secondary);
            font-size: 1rem;
        }
        /* Title Input */
        .title-input-group {
            margin-bottom: 25px;
        }
        .title-input {
            width: 100%;
            padding: 16px 20px;
            border-radius: 14px;
            border: 2px solid var(--sidebar-border);
            background: var(--card-bg);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .title-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
        }

        /* Keyword Highlighting */
        .highlighted-keyword {
            background-color: var(--highlight-bg);
            border: 1px solid var(--highlight-border);
            border-radius: 4px;
            padding: 0 2px;
        }

        /* Live Detection - Modified to be smaller and accommodate timers */
        .live-section {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(99, 102, 241, 0.1));
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            position: relative;
            min-height: 60px;
            display: flex;
            align-items: center;
            flex-wrap: wrap; /* Allow wrapping on small screens */
            gap: 10px; /* Space between items */
        }
        .timers-container {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
            margin-left: auto; /* Push to the right */
        }
        .timer {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--timer-text, var(--text-secondary)); /* Use specific dark mode color */
            background-color: var(--timer-bg, rgba(255, 255, 255, 0.5)); /* Slight background for readability */
            padding: 4px 8px;
            border-radius: 6px;
            white-space: nowrap; /* Prevent timer text from wrapping */
        }
        .timer.countdown {
            color: var(--warning); /* Different color for countdown */
        }
        .live-text-container {
            flex: 1;
            display: flex;
            align-items: center;
            min-width: 0; /* Allow flex item to shrink below content size */
            margin-right: 10px; /* Space before indicator */
        }
        .live-text {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary);
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .indicator {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--danger);
            transition: all 0.3s ease;
            animation: pulse 1.5s infinite;
            flex-shrink: 0; /* Prevent indicator from shrinking */
            margin-left: auto; /* Push to the far right */
        }
        .indicator.active {
            background: var(--success);
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.7);
            animation: glow 1.5s infinite;
        }
        @keyframes pulse {
            0% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.05); }
            100% { opacity: 0.6; transform: scale(1); }
        }
        @keyframes glow {
            0% { box-shadow: 0 0 8px rgba(16, 185, 129, 0.7); }
            50% { box-shadow: 0 0 15px rgba(16, 185, 129, 0.9); }
            100% { box-shadow: 0 0 8px rgba(16, 185, 129, 0.7); }
        }
        /* Transcription Area */
        .transcription-area {
            margin-bottom: 30px;
        }
        .transcription-label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1.1rem;
        }
        .transcription-text {
            width: 100%;
            min-height: 280px;
            padding: 22px;
            border-radius: 16px;
            border: 2px solid var(--sidebar-border);
            background: var(--card-bg);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 1.2rem;
            resize: vertical;
            line-height: 1.7;
            transition: all 0.3s ease;
            white-space: pre-wrap; /* Important for timestamps */
        }
        .transcription-text:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
        }
        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 35px;
        }
        .action-btn {
            padding: 16px 20px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            font-family: 'Inter', sans-serif;
            cursor: pointer;
        }
        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }
        .action-btn:active {
            transform: translateY(0);
        }
        .btn-copy {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 2px solid var(--success);
        }
        .btn-copy:hover {
            background: var(--success);
            color: white;
        }
        .btn-clear {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 2px solid var(--danger);
        }
        .btn-clear:hover {
            background: var(--danger);
            color: white;
        }
        .btn-save {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        .btn-save:hover {
            background: var(--primary);
            color: white;
        }
        .btn-audio {
            background: rgba(14, 165, 233, 0.1);
            color: var(--accent);
            border: 2px solid var(--accent);
        }
        .btn-audio:hover {
            background: var(--accent);
            color: white;
        }

        /* New Settings Section */
        .settings-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid var(--sidebar-border);
            box-shadow: var(--shadow);
            margin-bottom: 35px;
        }
        .settings-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--sidebar-border); /* Horizontal rule */
        }
        .settings-header h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.5rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0; /* Remove default margin */
        }
        .setting-group {
            margin-bottom: 20px;
        }
        .setting-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-primary);
        }
        .setting-input, .setting-select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 12px;
            border: 2px solid var(--sidebar-border);
            background: var(--card-bg);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .setting-input:focus, .setting-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        .setting-hint {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-top: 5px;
            display: block;
        }
        .setting-checkbox {
            width: auto; /* Reset default width */
            margin-right: 8px;
        }

        /* Stats Section */
        .stats-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid var(--sidebar-border);
            box-shadow: var(--shadow);
        }
        .stats-header {
            margin-bottom: 25px;
        }
        .stats-header h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.5rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 25px;
        }
        .stat-card {
            text-align: center;
            padding: 25px 20px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(139, 92, 246, 0.05));
            border-radius: 16px;
            border: 1px solid rgba(99, 102, 241, 0.1);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }
        .stat-label {
            font-size: 1.1rem;
            color: var(--text-secondary);
            font-weight: 500;
        }
        /* History Section */
        .history-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 35px;
            border: 1px solid var(--sidebar-border);
            box-shadow: var(--shadow);
        }
        .history-header {
            margin-bottom: 30px;
        }
        .history-header h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.8rem;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .history-header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-top: 8px;
        }
        .history-list {
            list-style: none;
        }
        .history-item {
            padding: 25px;
            border-bottom: 1px solid var(--sidebar-border);
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 16px;
            margin-bottom: 15px;
            background: rgba(241, 245, 249, 0.5);
        }
        .history-item:hover {
            background: rgba(99, 102, 241, 0.05);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .history-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .history-item-title {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1.2rem;
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .history-item-date {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-left: 15px;
            white-space: nowrap;
        }
        .history-item-content {
            font-size: 1.05rem;
            color: var(--text-secondary);
            margin-bottom: 20px;
            line-height: 1.6;
            white-space: pre-wrap;
            max-height: 90px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .history-item-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }
        .history-item-actions .action-btn {
            padding: 10px 18px;
            font-size: 0.95rem;
            min-width: auto;
        }
        /* Modals */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            display: none;
            backdrop-filter: blur(5px);
        }
        .modal-backdrop.active {
            display: block;
        }
        .modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--card-bg);
            border-radius: 20px;
            padding: 35px;
            width: 95%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            z-index: 2001;
            display: none;
        }
        .modal.active {
            display: block;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--sidebar-border);
        }
        .modal-header h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.6rem;
            color: var(--text-primary);
            margin: 0;
        }
        .close-modal {
            background: none;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: var(--text-light);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .close-modal:hover {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }
        .modal-body {
            margin-bottom: 30px;
        }
        .modal-textarea {
            width: 100%;
            min-height: 300px;
            padding: 20px;
            border-radius: 16px;
            border: 2px solid var(--sidebar-border);
            background: var(--card-bg);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 1.1rem;
            resize: vertical;
            line-height: 1.6;
        }
        .modal-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
        }
        .modal-footer {
            display: flex;
            gap: 20px;
            justify-content: flex-end;
        }
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 45px;
            padding-top: 30px;
            border-top: 1px solid var(--sidebar-border);
            color: var(--text-light);
            font-size: 1rem;
        }
        .footer a {
            color: var(--primary);
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }
            .sidebar-header h3 span, .nav-link span {
                display: none;
            }
            .nav-link {
                justify-content: center;
                padding: 16px 10px;
            }
            .nav-link i {
                font-size: 1.2rem;
            }
            .main-content {
                margin-left: 80px;
                padding: 25px;
            }
            .control-group {
                flex-direction: column;
                align-items: stretch;
            }
            .listen-btn, .language-select {
                width: 100%;
            }
            .timers-container {
                width: 100%;
                justify-content: space-between; /* Distribute timers on small screens */
            }
        }
        @media (max-width: 768px) {
            .top-nav {
                padding: 15px 20px;
            }
            .logo-text {
                font-size: 1.3rem;
            }
            .sidebar {
                width: 0;
                padding: 0;
                overflow: hidden;
            }
            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }
            .voice-card, .history-section {
                padding: 25px 20px;
            }
            .action-buttons {
                grid-template-columns: 1fr;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .live-text {
                font-size: 1.2rem;
            }
            .timers-container {
               flex-direction: column; /* Stack timers vertically on very small screens */
               align-items: flex-start;
            }
            .timer {
                font-size: 0.8rem; /* Smaller font for timers */
            }
        }
        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.8rem;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .modal {
                width: 95%;
                padding: 25px 20px;
            }
            .live-section {
                padding: 12px 15px; /* Further reduced padding */
                min-height: 50px; /* Further reduced height */
            }
            .live-text {
                font-size: 1.1rem; /* Smaller font on very small screens */
            }
            .indicator {
                width: 20px; /* Smaller indicator */
                height: 20px; /* Smaller indicator */
                right: 15px; /* Adjusted position */
            }
            .timers-container {
                gap: 5px; /* Reduce gap on very small screens */
            }
        }

        /* New Styles for Control Group */
        .control-group {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            justify-content: center; /* Center the buttons */
        }
        .listen-btn {
            padding: 16px 30px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            min-width: 220px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
        }
        .listen-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .listen-btn:active {
            transform: translateY(0);
        }
        .listen-btn.stop {
            background: linear-gradient(135deg, var(--danger), #dc2626);
            color: white;
        }
        .language-select {
            padding: 14px 20px;
            border-radius: 14px;
            border: 2px solid var(--sidebar-border);
            background: var(--card-bg);
            color: var(--text-primary);
            font-size: 1rem;
            min-width: 200px;
            font-weight: 500;
            /* Add some styling to make it look like other inputs */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .language-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
    </style>
</head>
<body class="light">
    <!-- Top Navigation -->
    <nav class="top-nav">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-microphone"></i>
            </div>
            <div class="logo-text">VoiceNote Pro</div>
        </div>
        <div class="nav-actions">
            <div class="theme-toggle" id="themeToggle">
                <i class="fas fa-moon"></i>
            </div>
        </div>
    </nav>
    <!-- Main Layout -->
    <div class="main-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-microphone-alt"></i> <span>Voice Tools</span></h3>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-section="voice-typing">
                        <i class="fas fa-keyboard"></i> <span>Voice Typing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-section="history">
                        <i class="fas fa-history"></i> <span>History</span>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="#" class="nav-link" data-section="advanced-settings">
                        <i class="fas fa-cog"></i> <span>Settings</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                 <!-- Removed Dark Mode Toggle from Sidebar -->
            </div>
        </aside>
        <!-- Main Content -->
        <main class="main-content">
            <!-- Voice Typing Section -->
            <section class="section active" id="voice-typing-section">
                <div class="voice-card">
                    <!-- Live Detection with Timers -->
                    <div class="live-section">
                        <div class="live-text-container">
                            <div class="live-text" id="liveText">Ready to listen...</div>
                        </div>
                        <div class="timers-container">
                            <div class="timer" id="sessionTimer">Session: 00:00</div>
                            <div class="timer countdown" id="countdownTimer">Auto-stop: 10s</div>
                        </div>
                        <div class="indicator" id="indicator"></div>
                    </div>
                    <!-- Title Input -->
                    <div class="title-input-group">
                        <input type="text" class="title-input" id="sessionTitle" placeholder="Enter session title..." value="Untitled Session">
                    </div>
                    <!-- Transcription Area -->
                    <div class="transcription-area">
                        <label class="transcription-label" for="transcriptionText">Transcribed Text</label>
                        <textarea class="transcription-text" id="transcriptionText" placeholder="Your transcribed text will appear here..."></textarea>
                    </div>
                    <!-- Control Group -->
                    <div class="control-group">
                        <button class="listen-btn start" id="toggleBtn">
                            <i class="fas fa-microphone"></i> Start Listening
                        </button>
                        <select class="language-select" id="languageSelect">
                            <option value="bn-BD">বাংলা (Bangla)</option>
                            <option value="en-US">English (US)</option>
                            <option value="hi-IN">हिन्दी (Hindi)</option>
                        </select>
                    </div>
                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button class="action-btn btn-copy" id="copyBtn">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                        <button class="action-btn btn-clear" id="clearBtn">
                            <i class="fas fa-trash"></i> Clear
                        </button>
                        <button class="action-btn btn-save" id="saveBtn">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <button class="action-btn btn-audio" id="playAudioBtn">
                            <i class="fas fa-volume-up"></i> Listen
                        </button>
                    </div>

                    <!-- Stats Section -->
                    <div class="stats-section">
                        <div class="stats-header">
                            <h3><i class="fas fa-chart-line"></i> Real-time Statistics</h3>
                        </div>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-value" id="wordCount">0</div>
                                <div class="stat-label">Words</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value" id="charCount">0</div>
                                <div class="stat-label">Characters</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value" id="lineCount">0</div>
                                <div class="stat-label">Lines</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value" id="sentenceCount">0</div>
                                <div class="stat-label">Sentences</div>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <p>Created with <i class="fas fa-heart" style="color: var(--danger);"></i> by VoiceNote Pro Team | &copy; 2023</p>
                    </div>
                </div>
            </section>
            <!-- History Section -->
            <section class="section" id="history-section">
                <div class="page-header">
                    <h1>Saved Transcriptions</h1>
                    <p>Manage and access your previously saved voice typing sessions</p>
                </div>
                <div class="history-section">
                    <div class="history-header">
                        <h2><i class="fas fa-history"></i> Transcription History</h2>
                        <p>Your saved voice typing sessions</p>
                    </div>
                    <ul class="history-list" id="historyList">
                        <!-- History items will be populated here -->
                    </ul>
                </div>
            </section>

             <!-- Advanced Settings Section -->
            <section class="section" id="advanced-settings-section">
                <div class="page-header">
                    <h1>Settings</h1>
                    <p>Configure your voice typing experience</p>
                </div>
                <div class="settings-section">
                    <div class="settings-header">
                        <h3><i class="fas fa-sliders-h"></i> Voice Typing Settings</h3>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label" for="keywordsInput">Keywords to Highlight (comma-separated)</label>
                        <input type="text" class="setting-input" id="keywordsInput" placeholder="e.g., project, meeting, deadline">
                        <span class="setting-hint">Keywords will be highlighted in the transcription.</span>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">
                            <input type="checkbox" class="setting-checkbox" id="timestampsCheckbox"> Add Timestamps
                        </label>
                        <span class="setting-hint">Adds time markers to each line of transcription.</span>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label" for="countdownSelect">Auto-stop Silence Duration</label>
                        <select class="setting-select" id="countdownSelect">
                            <option value="5">5 seconds</option>
                            <option value="10" selected>10 seconds</option>
                            <option value="15">15 seconds</option>
                            <option value="20">20 seconds</option>
                            <option value="30">30 seconds</option>
                        </select>
                        <span class="setting-hint">Listening will stop automatically after this duration of silence.</span>
                    </div>
                </div>

                 <div class="settings-section">
                    <div class="settings-header">
                        <h3><i class="fas fa-history"></i> Local History Settings</h3>
                    </div>
                    <div class="setting-group">
                        <label class="setting-label">
                            <input type="checkbox" class="setting-checkbox" id="localHistoryCheckbox" checked> Enable Local History
                        </label>
                        <span class="setting-hint">Saves transcriptions in your browser's local storage.</span>
                    </div>
                    <div class="action-buttons">
                        <button class="action-btn btn-clear" id="clearLocalHistoryBtn">
                            <i class="fas fa-trash"></i> Clear Local History
                        </button>
                    </div>
                </div>

                 <div class="footer">
                    <p>Settings are saved locally in your browser.</p>
                </div>
            </section>
        </main>
    </div>
    <!-- Detail Modal -->
    <div class="modal-backdrop" id="detailBackdrop"></div>
    <div class="modal" id="detailModal">
        <div class="modal-header">
            <h3 id="detailModalTitle">Transcription Details</h3>
            <button class="close-modal" id="closeDetailModal">&times;</button>
        </div>
        <div class="modal-body">
            <textarea class="modal-textarea" id="detailTextarea" placeholder="Transcription content..."></textarea>
        </div>
        <div class="modal-footer">
            <button class="action-btn btn-clear" id="deleteFromDetailBtn">
                <i class="fas fa-trash"></i> Delete
            </button>
            <button class="action-btn btn-save" id="saveFromDetailBtn">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>
    </div>
    <!-- Confirm Modal -->
    <div class="modal-backdrop" id="confirmBackdrop"></div>
    <div class="modal" id="confirmModal">
        <div class="modal-header">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Confirm Delete</h3>
            <button class="close-modal" id="closeConfirmModal">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this transcription? This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button class="action-btn btn-clear" id="cancelDeleteBtn">Cancel</button>
            <button class="action-btn btn-save" id="confirmDeleteBtn">Yes, Delete</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // DOM Elements
        const liveText = document.getElementById('liveText');
        const indicator = document.getElementById('indicator');
        const languageSelect = document.getElementById('languageSelect');
        const themeToggle = document.getElementById('themeToggle');
        const detailBackdrop = document.getElementById('detailBackdrop');
        const detailModal = document.getElementById('detailModal');
        const closeDetailModal = document.getElementById('closeDetailModal');
        const detailTextarea = document.getElementById('detailTextarea');
        const detailModalTitle = document.getElementById('detailModalTitle');
        const deleteFromDetailBtn = document.getElementById('deleteFromDetailBtn');
        const saveFromDetailBtn = document.getElementById('saveFromDetailBtn');
        const confirmBackdrop = document.getElementById('confirmBackdrop');
        const confirmModal = document.getElementById('confirmModal');
        const closeConfirmModal = document.getElementById('closeConfirmModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        // --- New DOM Elements for Features ---
        const sessionTimer = document.getElementById('sessionTimer');
        const countdownTimer = document.getElementById('countdownTimer');
        const keywordsInput = document.getElementById('keywordsInput');
        const timestampsCheckbox = document.getElementById('timestampsCheckbox');
        const countdownSelect = document.getElementById('countdownSelect');
        const clearLocalHistoryBtn = document.getElementById('clearLocalHistoryBtn');

        // Section navigation
        const navLinks = document.querySelectorAll('[data-section]');
        const sections = document.querySelectorAll('.section');
        // Speech Recognition
        let recognition;
        let isListening = false;
        let isManuallyStopped = false;
        let currentSessionKey = 'session_' + Date.now();
        let currentDetailId = null;
        let pendingDeleteId = null;
        // Text-to-Speech
        let speechSynthesis = window.speechSynthesis;
        let voices = [];
        // Auto-save timer
        let autoSaveTimer = null;
        let lastContent = '';
        let lastTitle = '';
        const autoSaveInterval = 2000;

        // --- New Feature Variables ---
        let startTime = null; // For session timer
        let silenceTimer = null; // For countdown timer / auto-stop
        let countdownValue = parseInt(countdownSelect.value) || 10; // Initial countdown value in seconds
        let sessionTimerInterval = null; // Interval ID for session timer
        let countdownTimerInterval = null; // Interval ID for countdown timer display
        let totalSessionTime = 0; // Total time listened (in ms)
        let sessionPauseTime = null; // Time when session was paused

        // --- Feature Functions ---

        // Theme toggle function
        function toggleTheme() {
            document.body.classList.toggle('dark');
            const isDark = document.body.classList.contains('dark');
            const themeIcon = themeToggle.querySelector('i');
            if (isDark) {
                themeIcon.className = 'fas fa-sun';
            } else {
                themeIcon.className = 'fas fa-moon';
            }
            // Save theme preference to localStorage
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Load theme preference from localStorage
        function loadThemePreference() {
             const savedTheme = localStorage.getItem('theme');
             if (savedTheme === 'dark') {
                 document.body.classList.add('dark');
                 themeToggle.querySelector('i').className = 'fas fa-sun';
             } else {
                  // Default is light, ensure class is removed if it was set before
                  document.body.classList.remove('dark');
                  themeToggle.querySelector('i').className = 'fas fa-moon';
             }
        }

        // Section navigation
        function showSection(sectionId) {
            sections.forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(`${sectionId}-section`).classList.add('active');
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-section') === sectionId) {
                    link.classList.add('active');
                }
            });
            if (sectionId === 'history') {
                updateHistoryList();
            }
        }

        // --- Timer Functions ---
        function startSessionTimer() {
            if (!startTime) {
                startTime = new Date();
            } else if (sessionPauseTime) {
                // Resume from pause: adjust start time to account for paused duration
                const pauseDuration = new Date() - sessionPauseTime;
                startTime = new Date(startTime.getTime() + pauseDuration);
                sessionPauseTime = null;
            }
            
            sessionTimerInterval = setInterval(() => {
                const now = new Date();
                const diff = new Date(now - startTime);
                const minutes = diff.getUTCMinutes().toString().padStart(2, '0');
                const seconds = diff.getUTCSeconds().toString().padStart(2, '0');
                sessionTimer.textContent = `Session: ${minutes}:${seconds}`;
            }, 1000);
        }

        function pauseSessionTimer() {
            if (sessionTimerInterval) {
                clearInterval(sessionTimerInterval);
                sessionTimerInterval = null;
                sessionPauseTime = new Date(); // Record pause time
            }
        }

        function stopSessionTimer() {
            if (sessionTimerInterval) {
                clearInterval(sessionTimerInterval);
                sessionTimerInterval = null;
            }
            if (startTime && !sessionPauseTime) {
                // If not already paused, add the final segment to total time
                totalSessionTime += (new Date() - startTime);
            } else if (sessionPauseTime && startTime) {
                // If paused, add the time from start to pause
                totalSessionTime += (sessionPauseTime - startTime);
            }
            startTime = null;
            sessionPauseTime = null;
            
            // Update display with total time
            const totalDiff = new Date(totalSessionTime);
            const minutes = totalDiff.getUTCMinutes().toString().padStart(2, '0');
            const seconds = totalDiff.getUTCSeconds().toString().padStart(2, '0');
            sessionTimer.textContent = `Session: ${minutes}:${seconds}`;
        }

        function startCountdownTimer() {
             // Clear any existing countdown timer
             if (countdownTimerInterval) {
                 clearInterval(countdownTimerInterval);
             }
             let remainingTime = countdownValue; // Use the current countdown value

             // Update display immediately
             countdownTimer.textContent = `Auto-stop: ${remainingTime}s`;

             countdownTimerInterval = setInterval(() => {
                 remainingTime--;
                 countdownTimer.textContent = `Auto-stop: ${remainingTime}s`;
                 if (remainingTime <= 0) {
                     clearInterval(countdownTimerInterval);
                     countdownTimerInterval = null;
                     // Auto-stop recognition if it's still listening
                     if (isListening && !isManuallyStopped) {
                         console.log("Countdown reached zero, stopping recognition...");
                         isListening = false;
                         isManuallyStopped = true;
                         if (recognition) {
                             recognition.stop();
                         }
                     }
                 }
             }, 1000);
         }

         function resetCountdownTimer() {
             // Clear the existing timer
             if (countdownTimerInterval) {
                 clearInterval(countdownTimerInterval);
             }
             // Restart it
             startCountdownTimer();
         }

         function stopCountdownTimer() {
             if (countdownTimerInterval) {
                 clearInterval(countdownTimerInterval);
                 countdownTimerInterval = null;
             }
             countdownTimer.textContent = `Auto-stop: ${countdownValue}s`; // Reset display
         }

        // --- Enhanced Speech Recognition ---
        function initRecognition(language) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                alert("Speech recognition is not supported in your browser. Please use Chrome or Edge.");
                return;
            }
            recognition = new SpeechRecognition();
            recognition.continuous = true;
            recognition.interimResults = true;
            recognition.lang = language;
            recognition.maxAlternatives = 1;

            recognition.onresult = (event) => {
                let finalTranscript = "";
                let interimTranscript = "";
                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript + " ";
                        // Reset countdown timer on final result (speech detected)
                        resetCountdownTimer();
                        // Resume session timer if it was paused
                        if (sessionPauseTime) {
                            startSessionTimer();
                        }
                    } else {
                        interimTranscript += transcript;
                    }
                }

                // Update live detection text
                if (interimTranscript.trim()) {
                    const words = interimTranscript.trim().split(/\s+/);
                    const currentWord = words[words.length - 1];
                    liveText.textContent = currentWord;
                    indicator.className = "indicator active";
                } else if (finalTranscript) {
                    liveText.textContent = "Listening...";
                    indicator.className = "indicator active";
                } else {
                    if (isListening && !isManuallyStopped) {
                        liveText.textContent = "Listening...";
                        indicator.className = "indicator active";
                    }
                }

                // Handle final transcript
                if (finalTranscript) {
                    // Add timestamp if enabled
                    let lineToAdd = finalTranscript;
                    if (timestampsCheckbox.checked && startTime) {
                        const currentTime = new Date();
                        // Calculate time since session start
                        const diff = new Date(currentTime - startTime);
                        const minutes = diff.getUTCMinutes().toString().padStart(2, '0');
                        const seconds = diff.getUTCSeconds().toString().padStart(2, '0');
                        const formattedTime = `[${minutes}:${seconds}] `;
                        lineToAdd = formattedTime + finalTranscript;
                    }

                    // Add to textarea
                    transcriptionText.value += lineToAdd;
                    transcriptionText.scrollTop = transcriptionText.scrollHeight;

                    // Highlight keywords
                    // highlightKeywords(); // Removed for textarea complexity in main view

                    // Update stats
                    updateStats();

                    // Trigger auto-save
                    triggerAutoSave();

                    // Reset live text
                    liveText.textContent = "Listening...";
                    indicator.className = "indicator active";
                }
            };

            recognition.onstart = () => {
                isListening = true;
                isManuallyStopped = false;
                // Reset total session time and start time for a new session
                totalSessionTime = 0;
                startTime = new Date();
                sessionPauseTime = null;
                liveText.textContent = "Listening...";
                indicator.className = "indicator active";
                toggleBtn.innerHTML = '<i class="fas fa-stop"></i> Stop Listening';
                toggleBtn.classList.remove('start');
                toggleBtn.classList.add('stop');

                // Start timers
                startSessionTimer();
                startCountdownTimer();
            };

            recognition.onspeechstart = () => {
                console.log("Speech started");
                // Resume session timer if it was paused
                if (sessionPauseTime) {
                    startSessionTimer();
                }
            };

            recognition.onspeechend = () => {
                console.log("Speech ended");
                // Pause session timer when speech ends
                pauseSessionTimer();
            };

            recognition.onend = () => {
                if (isListening && !isManuallyStopped) {
                    recognition.start(); // Auto-restart
                } else {
                    isListening = false;
                    liveText.textContent = "Ready to listen...";
                    indicator.className = "indicator";
                    toggleBtn.innerHTML = '<i class="fas fa-microphone"></i> Start Listening';
                    toggleBtn.classList.remove('stop');
                    toggleBtn.classList.add('start');

                    // Stop timers
                    stopSessionTimer();
                    stopCountdownTimer();
                }
            };

            recognition.onerror = (event) => {
                console.error("Speech Recognition Error: ", event.error);
                isListening = false;
                liveText.textContent = "Error: " + event.error;
                indicator.className = "indicator";
                toggleBtn.innerHTML = '<i class="fas fa-microphone"></i> Start Listening';
                toggleBtn.classList.remove('stop');
                toggleBtn.classList.add('start');

                 // Stop timers on error
                stopSessionTimer();
                stopCountdownTimer();
            };

            recognition.start();
        }

        // Update statistics
        function updateStats() {
            const text = transcriptionText.value;
            document.getElementById('wordCount').textContent = text.trim() ? text.trim().split(/\s+/).length : 0;
            document.getElementById('charCount').textContent = text.length;
            // Count lines based on actual lines, not just newlines
            const lines = text.split('\n').filter(line => line.trim() !== '');
            document.getElementById('lineCount').textContent = lines.length;
            document.getElementById('sentenceCount').textContent = text.split(/[.!?]+/).filter(s => s.trim()).length;
        }

        // Text-to-Speech function
        function speakText() {
            const text = transcriptionText.value;
            if (!text.trim()) {
                alert("Please write something to listen.");
                return;
            }
            speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.volume = 1;
            utterance.rate = 0.9;
            utterance.pitch = 1;
            voices = speechSynthesis.getVoices();
            let selectedVoice = voices.find(voice =>
                voice.lang.includes(languageSelect.value.split('-')[0])
            );
            if (selectedVoice) {
                utterance.voice = selectedVoice;
            } else {
                utterance.lang = languageSelect.value;
            }
            speechSynthesis.speak(utterance);
            playAudioBtn.innerHTML = '<i class="fas fa-stop"></i> Stop';
            playAudioBtn.onclick = stopSpeaking;
            utterance.onend = () => {
                playAudioBtn.innerHTML = '<i class="fas fa-volume-up"></i> Listen';
                playAudioBtn.onclick = speakText;
            };
        }

        // Stop speaking function
        function stopSpeaking() {
            speechSynthesis.cancel();
            playAudioBtn.innerHTML = '<i class="fas fa-volume-up"></i> Listen';
            playAudioBtn.onclick = speakText;
        }

        // Auto-save functionality
        function triggerAutoSave() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                autoSaveContent();
            }, autoSaveInterval);
        }

        // Auto-save current content
        function autoSaveContent() {
            const currentContent = transcriptionText.value.trim();
            const title = sessionTitle.value.trim() || 'Untitled Session';
            if (currentContent && (currentContent !== lastContent || title !== lastTitle)) {
                fetch('save_note.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `title=${encodeURIComponent(title)}&content=${encodeURIComponent(currentContent)}`
                })
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        throw new Error('Response is not JSON: ' + contentType);
                    }
                })
                .then(data => {
                    if (data.success) {
                        console.log("Auto-saved content");
                        if (document.getElementById('history-section').classList.contains('active')) {
                            updateHistoryList();
                        }
                    } else {
                        console.error("Auto-save failed:", data.message);
                    }
                })
                .catch(error => {
                    console.error("Auto-save error:", error);
                });
                lastContent = currentContent;
                lastTitle = title;
            }
        }

        // Manual save
        function saveToHistory() {
            const text = transcriptionText.value;
            const title = sessionTitle.value.trim() || 'Untitled Session';
            if (!text.trim()) {
                alert("Please write something to save.");
                return;
            }
            fetch('save_note.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `title=${encodeURIComponent(title)}&content=${encodeURIComponent(text)}`
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error('Server returned non-JSON response: ' + text);
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    alert("Transcription saved successfully!");
                    if (document.getElementById('history-section').classList.contains('active')) {
                        updateHistoryList();
                    }
                    lastContent = text;
                    lastTitle = title;
                } else {
                    alert("Save failed: " + data.message);
                }
            })
            .catch(error => {
                alert("Save error: " + error.message);
                console.error("Save error details:", error);
            });
        }

        // Update history list (from server)
        function updateHistoryList() {
            fetch('get_notes.php')
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error('Server returned non-JSON response: ' + text);
                    });
                }
            })
            .then(data => {
                const historyList = document.getElementById('historyList');
                historyList.innerHTML = '';
                if (data.success && data.data.length > 0) {
                    data.data.forEach(item => {
                        const li = document.createElement('li');
                        li.className = 'history-item';
                        li.innerHTML = `
                            <div class="history-item-header">
                                <div class="history-item-title">${item.title}</div>
                                <div class="history-item-date">${new Date(item.created_at).toLocaleString()}</div>
                            </div>
                            <div class="history-item-content">${item.content.substring(0, 120)}${item.content.length > 120 ? '...' : ''}</div>
                            <div class="history-item-actions">
                                <button class="action-btn btn-save view-detail" data-id="${item.id}">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="action-btn btn-copy load-history" data-id="${item.id}">
                                    <i class="fas fa-play"></i> Load
                                </button>
                                <button class="action-btn btn-clear delete-history" data-id="${item.id}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        `;
                        historyList.appendChild(li);
                    });
                    document.querySelectorAll('.load-history').forEach(button => {
                        button.addEventListener('click', function() {
                            const id = parseInt(this.getAttribute('data-id'));
                            loadNote(id);
                        });
                    });
                    document.querySelectorAll('.delete-history').forEach(button => {
                        button.addEventListener('click', function() {
                            const id = parseInt(this.getAttribute('data-id'));
                            showDeleteConfirm(id);
                        });
                    });
                    document.querySelectorAll('.view-detail').forEach(button => {
                        button.addEventListener('click', function() {
                            const id = parseInt(this.getAttribute('data-id'));
                            showDetailModal(id);
                        });
                    });
                } else {
                    historyList.innerHTML = '<li class="history-item">No saved transcriptions yet. Start speaking to create your first one!</li>';
                }
            })
            .catch(error => {
                console.error("Error loading history:", error);
                document.getElementById('historyList').innerHTML = '<li class="history-item">Error loading transcriptions. Please try again.</li>';
            });
        }

        // Show detail modal
        function showDetailModal(id) {
            fetch(`get_note.php?id=${id}`)
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error('Server returned non-JSON response: ' + text);
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    currentDetailId = id;
                    detailModalTitle.textContent = data.data.title;
                    detailTextarea.value = data.data.content;
                    detailBackdrop.classList.add('active');
                    detailModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                } else {
                    alert("Load failed: " + data.message);
                }
            })
            .catch(error => {
                alert("Load error: " + error.message);
                console.error("Load error details:", error);
            });
        }

        // Hide detail modal
        function hideDetailModal() {
            detailBackdrop.classList.remove('active');
            detailModal.classList.remove('active');
            document.body.style.overflow = '';
            currentDetailId = null;
        }

        // Save from detail modal
        function saveFromDetail() {
            if (currentDetailId) {
                const content = detailTextarea.value;
                const title = detailModalTitle.textContent;
                fetch('update_note.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${currentDetailId}&title=${encodeURIComponent(title)}&content=${encodeURIComponent(content)}`
                })
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            throw new Error('Server returned non-JSON response: ' + text);
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        alert("Transcription updated successfully!");
                        hideDetailModal();
                        updateHistoryList();
                    } else {
                        alert("Update failed: " + data.message);
                    }
                })
                .catch(error => {
                    alert("Update error: " + error.message);
                    console.error("Update error details:", error);
                });
            }
        }

        // Delete from detail modal
        function deleteFromDetail() {
            if (currentDetailId) {
                showDeleteConfirm(currentDetailId);
            }
        }

        // Load note to editor (from server)
        function loadNote(id) {
            fetch(`get_note.php?id=${id}`)
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error('Server returned non-JSON response: ' + text);
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    transcriptionText.value = data.data.content;
                    sessionTitle.value = data.data.title;
                    updateStats();
                    showSection('voice-typing');
                    currentSessionKey = 'session_' + Date.now();
                    lastContent = '';
                    lastTitle = '';
                } else {
                    alert("Load failed: " + data.message);
                }
            })
            .catch(error => {
                alert("Load error: " + error.message);
                console.error("Load error details:", error);
            });
        }

        // Show delete confirmation
        function showDeleteConfirm(id) {
            pendingDeleteId = id;
            confirmBackdrop.classList.add('active');
            confirmModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Hide delete confirmation
        function hideDeleteConfirm() {
            confirmBackdrop.classList.remove('active');
            confirmModal.classList.remove('active');
            document.body.style.overflow = '';
            pendingDeleteId = null;
        }

        // Delete note (from server)
        function deleteNote() {
            if (pendingDeleteId) {
                fetch('delete_note.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${pendingDeleteId}`
                })
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            throw new Error('Server returned non-JSON response: ' + text);
                        });
                    }
                })
                .then(data => {
                    if (data.success) {
                        updateHistoryList();
                        hideDeleteConfirm();
                        if (detailModal.classList.contains('active')) {
                            hideDetailModal();
                        }
                    } else {
                        alert("Delete failed: " + data.message);
                        hideDeleteConfirm();
                    }
                })
                .catch(error => {
                    alert("Delete error: " + error.message);
                    console.error("Delete error details:", error);
                    hideDeleteConfirm();
                });
            }
        }

        // Clear session
        function clearSession() {
            transcriptionText.value = "";
            sessionTitle.value = "Untitled Session";
            updateStats();
            currentSessionKey = 'session_' + Date.now();
            lastContent = '';
            lastTitle = '';
            const originalText = clearBtn.innerHTML;
            clearBtn.innerHTML = '<i class="fas fa-check"></i> Cleared!';
            setTimeout(() => {
                clearBtn.innerHTML = originalText;
            }, 2000);
        }

        // --- New Feature Functions ---

        // Audio Feedback (stub - can be implemented if needed)
        // function playAudioFeedback(type) { ... }

        // Keyboard Shortcuts (Hotkeys) (stub - can be implemented if needed)
        // function handleKeyboardShortcuts(event) { ... }

        // DOM Elements for buttons
        const toggleBtn = document.getElementById('toggleBtn');
        const transcriptionText = document.getElementById('transcriptionText');
        const copyBtn = document.getElementById('copyBtn');
        const clearBtn = document.getElementById('clearBtn');
        const saveBtn = document.getElementById('saveBtn');
        const playAudioBtn = document.getElementById('playAudioBtn');

        // Event Listeners
        toggleBtn.addEventListener('click', () => {
            if (!isListening) {
                if (!recognition) {
                    initRecognition(languageSelect.value);
                } else {
                    isListening = true;
                    isManuallyStopped = false;
                    recognition.start();
                }
            } else {
                isListening = false;
                isManuallyStopped = true;
                if (recognition) {
                    recognition.stop();
                }
            }
        });

        copyBtn.addEventListener('click', () => {
            transcriptionText.select();
            document.execCommand('copy');
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
            }, 2000);
        });

        clearBtn.addEventListener('click', clearSession);
        saveBtn.addEventListener('click', saveToHistory);
        playAudioBtn.addEventListener('click', speakText);

        languageSelect.addEventListener('change', () => {
            if (isListening) {
                recognition.stop();
                initRecognition(languageSelect.value);
            }
        });

        // --- New Event Listeners for Features ---

        // Trigger stats update on text change
        transcriptionText.addEventListener('input', () => {
            updateStats();
            triggerAutoSave();
        });

        // Save settings to localStorage when they change
        keywordsInput.addEventListener('input', () => {
            localStorage.setItem('keywords', keywordsInput.value);
        });
        timestampsCheckbox.addEventListener('change', () => {
            localStorage.setItem('timestampsEnabled', timestampsCheckbox.checked);
        });
        countdownSelect.addEventListener('change', () => {
            const newValue = parseInt(countdownSelect.value);
            if (!isNaN(newValue)) {
                countdownValue = newValue;
                localStorage.setItem('countdownValue', countdownValue);
                // If listening, reset the countdown timer with the new value
                if (isListening) {
                     resetCountdownTimer();
                } else {
                     // Just update the display if not listening
                     countdownTimer.textContent = `Auto-stop: ${countdownValue}s`;
                }
            }
        });

        // Load settings from localStorage on startup
        function loadSettings() {
            const savedKeywords = localStorage.getItem('keywords');
            if (savedKeywords !== null) {
                keywordsInput.value = savedKeywords;
            }

            const savedTimestamps = localStorage.getItem('timestampsEnabled');
            if (savedTimestamps !== null) {
                timestampsCheckbox.checked = (savedTimestamps === 'true');
            }

            const savedCountdown = localStorage.getItem('countdownValue');
            if (savedCountdown !== null) {
                const parsedValue = parseInt(savedCountdown);
                if (!isNaN(parsedValue)) {
                    countdownValue = parsedValue;
                    countdownSelect.value = countdownValue;
                     // Update display
                     countdownTimer.textContent = `Auto-stop: ${countdownValue}s`;
                }
            }
        }

        // Navigation
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const sectionId = link.getAttribute('data-section');
                showSection(sectionId);
            });
        });

        // Theme toggle (only one now)
        themeToggle.addEventListener('click', toggleTheme);

        // Modal events
        closeDetailModal.addEventListener('click', hideDetailModal);
        detailBackdrop.addEventListener('click', (e) => {
            if (e.target === detailBackdrop) {
                hideDetailModal();
            }
        });
        deleteFromDetailBtn.addEventListener('click', deleteFromDetail);
        saveFromDetailBtn.addEventListener('click', saveFromDetail);
        closeConfirmModal.addEventListener('click', hideDeleteConfirm);
        confirmBackdrop.addEventListener('click', (e) => {
            if (e.target === confirmBackdrop) {
                hideDeleteConfirm();
            }
        });
        cancelDeleteBtn.addEventListener('click', hideDeleteConfirm);
        confirmDeleteBtn.addEventListener('click', deleteNote);

        // Live update for detail modal (with save)
        detailTextarea.addEventListener('input', () => {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                saveFromDetail();
            }, 1000);
        });

        // Session title auto-save trigger
        sessionTitle.addEventListener('input', triggerAutoSave);

        // --- Local History Event Listeners ---
        clearLocalHistoryBtn.addEventListener('click', () => {
             if (confirm("Are you sure you want to clear ALL local history? This cannot be undone.")) {
                 localStorage.removeItem('voiceNoteLocalHistory');
                 // Provide feedback
                 const originalText = clearLocalHistoryBtn.innerHTML;
                 clearLocalHistoryBtn.innerHTML = '<i class="fas fa-check"></i> Cleared!';
                 clearLocalHistoryBtn.classList.remove('btn-clear');
                 clearLocalHistoryBtn.classList.add('btn-save');
                 setTimeout(() => {
                     clearLocalHistoryBtn.innerHTML = originalText;
                     clearLocalHistoryBtn.classList.remove('btn-save');
                     clearLocalHistoryBtn.classList.add('btn-clear');
                 }, 2000);
             }
        });

        // --- Initialize ---
        loadThemePreference(); // Load theme first
        loadSettings(); // Load user settings
        updateStats();
        if (typeof speechSynthesis !== 'undefined' && speechSynthesis.onvoiceschanged !== undefined) {
            speechSynthesis.onvoiceschanged = () => {
                voices = speechSynthesis.getVoices();
            };
        }
        updateHistoryList();
        // Initial auto-save triggers
        transcriptionText.addEventListener('input', triggerAutoSave);
        sessionTitle.addEventListener('input', triggerAutoSave);
    </script>
</body>
</html>