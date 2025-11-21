@extends('client.layout.client-layout')
@section('title', 'Jobboard Client - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jobboard Client</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        :root {
            --blue-700: #1d4ed8;
            --blue-800: #1e40af;
            --green-600: #059669;
            --green-700: #047857;
            --yellow-600: #d97706;
            --yellow-700: #b45309;
            --red-600: #dc2626;
            --red-700: #b91c1c;
            --purple-600: #7c3aed;
            --purple-700: #6d28d9;
            --orange-600: #ea580c;
            --orange-700: #c2410c;
            --gray-200: #e5e7eb;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-50: #f9fafb;
            --bg: #f8fbff;
            --radius-sm: 6px;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, .06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            font-family: 'Inter', sans-serif;
            color: var(--gray-900);
        }

        button {
            cursor: pointer;
            background: none;
            border: none;
        }

        main {
            padding: 1rem 1.5rem;
            max-width: 100%;
            margin: 0 auto;
        }

        h1 {
            color: var(--blue-700);
            font-weight: 600;
            font-size: 1.25rem;
        }

        .subtitle {
            color: var(--gray-700);
            font-size: .75rem;
            margin-bottom: 1.5rem;
        }

        .card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-sm);
        }

        .tabs {
            display: flex;
            gap: 1.5rem;
            padding: 0 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .tab {
            padding: .75rem 0;
            font-size: .75rem;
            color: var(--gray-500);
            border-bottom: 2px solid transparent;
        }

        .tab[aria-current="page"] {
            color: var(--blue-700);
            font-weight: 600;
            border-bottom-color: var(--blue-700);
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 97%;
            border-collapse: collapse;
            font-size: .75rem;
            margin: 15px;
            color: var(--gray-700);
        }

        th, td {
            border: 1px solid var(--gray-200);
            padding: .5rem;
            text-align: left;
        }

        thead {
            background: var(--gray-50);
            color: var(--gray-600);
        }

        tbody tr:hover { background: var(--gray-50); }

        /* Updated table column widths for all tables */
        .applied-table thead th:nth-child(1) { width: 5%; }
        .applied-table thead th:nth-child(2) { width: 20%; }
        .applied-table thead th:nth-child(3) { width: 12%; }
        .applied-table thead th:nth-child(4) { width: 15%; } /* Freelancer */
        .applied-table thead th:nth-child(5) { width: 10%; } /* Deadline */
        .applied-table thead th:nth-child(6) { width: 10%; }
        .applied-table thead th:nth-child(7) { width: 28%; }

        .working-table thead th:nth-child(1) { width: 5%; }
        .working-table thead th:nth-child(2) { width: 18%; }
        .working-table thead th:nth-child(3) { width: 12%; } /* Freelancer */
        .working-table thead th:nth-child(4) { width: 10%; } /* Deadline */
        .working-table thead th:nth-child(5) { width: 12%; }
        .working-table thead th:nth-child(6) { width: 10%; }
        .working-table thead th:nth-child(7) { width: 8%; }
        .working-table thead th:nth-child(8) { width: 25%; }

        .completed-table thead th:nth-child(1) { width: 4%; }
        .completed-table thead th:nth-child(2) { width: 16%; }
        .completed-table thead th:nth-child(3) { width: 12%; } /* Freelancer */
        .completed-table thead th:nth-child(4) { width: 10%; } /* Deadline */
        .completed-table thead th:nth-child(5) { width: 10%; }
        .completed-table thead th:nth-child(6) { width: 10%; }
        .completed-table thead th:nth-child(7) { width: 15%; }
        .completed-table thead th:nth-child(8) { width: 20%; }
        .completed-table thead th:nth-child(9) { width: 20%; }
        .completed-table thead th:nth-child(10) { width: 8%; }

        td a {
            color: var(--blue-700);
            text-decoration: none;
            font-weight: 600;
        }

        td a:hover { text-decoration: underline; }

        .hidden { display: none; }

        .action-buttons {
            display: flex;
            gap: 0.25rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.675rem;
            font-weight: 500;
            border-radius: 3px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-width: 60px;
            transition: all 0.2s;
        }

        .btn-view { background: var(--blue-700); color: white; }
        .btn-view:hover { background: var(--blue-800); color: white; }
        .btn-detail { background: var(--purple-600); color: white; }
        .btn-detail:hover { background: var(--purple-700); color: white; }
        .btn-monitor { background: var(--green-600); color: white; }
        .btn-monitor:hover { background: var(--green-700); color: white; }
        .btn-results { background: var(--orange-600); color: white; }
        .btn-results:hover { background: var(--orange-700); color: white; }
        .btn-chat { background: var(--blue-700); color: white; }
        .btn-chat:hover { background: var(--blue-800); color: white; }
        .btn-drive { background: var(--green-600); color: white; padding: 0.2rem 0.4rem; font-size: 0.65rem; margin-bottom: 0.2rem; }
        .btn-drive:hover { background: var(--green-700); color: white; }
        .btn-accept { background: var(--green-600); color: white; }
        .btn-accept:hover { background: var(--green-700); color: white; }
        .btn-revision { background: var(--orange-600); color: white; }
        .btn-revision:hover { background: var(--orange-700); color: white; }
        .btn-edit-notes { background: var(--purple-600); color: white; }
        .btn-edit-notes:hover { background: var(--purple-700); color: white; }
        .btn-edit { background: var(--yellow-600); color: white; }
        .btn-edit:hover { background: var(--yellow-700); color: white; }
        .btn-delete { background: var(--red-600); color: white; }
        .btn-delete:hover { background: var(--red-700); color: white; }
        .btn-tutorial {
            background: var(--purple-600);
            color: white;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            margin: 1rem 0;
            box-shadow: var(--shadow-sm);
        }

        .btn-tutorial:hover {
            background: var(--purple-700);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending { background: #fef3c7; color: var(--yellow-700); }
        .status-working { background: #dbeafe; color: var(--blue-700); }
        .status-revision { background: #ff0101ff; color: var(--red-800); }
        .status-completed { background: #d1fae5; color: var(--green-700); }

        /* Deadline Badge Style */
        .deadline-badge {
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 600;
            display: inline-block;
            background: #ff0101ff;
            color: white;
            min-width: 40px;
            text-align: center;
        }

        .progress-container {
            background: #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
            height: 16px;
            margin-top: 2px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--blue-700), var(--green-600));
            transition: width 0.3s ease;
            border-radius: 8px;
        }

.modal {
    display: none;
    position: fixed;
    top: 40px;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1000;
    animation: fadeIn 0.3s ease-out;
    /* PENTING: Pastikan flexbox properties ini ada */
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal.show {
    display: flex !important; /* Tambahkan !important untuk override */
}

/* Modal Content Container */
.modal-content {
    background: white;
    border-radius: 16px;
    box-shadow: 
        0 25px 50px -12px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.05);
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    overflow: hidden;
    animation: slideUp 0.3s ease-out;
    /* REMOVE margin properties yang bisa interfere */
    margin: 0;
    padding: 0;
    /* Pastikan tidak ada positioning yang interfere */
    position: relative;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { 
        opacity: 0; 
        transform: translateY(30px) scale(0.95);
    }
    to { 
        opacity: 1; 
        transform: translateY(0) scale(1);
    }
}

/* UPDATE CSS MODAL HEADER - GANTI YANG SUDAH ADA */

/* Modal Header dengan background putih */
.modal-header {
    background: white;
    color: #1e293b; /* Dark text for better contrast */
    padding: 24px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 2px solid #e2e8f0; /* Subtle border to separate from body */
    margin: 0;
    border-radius: 16px 16px 0 0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.modal-title-section {
    flex: 1;
}

.modal-title {
    font-size: 24px;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #1e293b; /* Dark blue-gray for professional look */
}

.modal-title i {
    color: #3b82f6; /* Keep icon blue for brand consistency */
}

.modal-subtitle {
    font-size: 14px;
    opacity: 0.7;
    margin-top: 4px;
    font-weight: 400;
    color: #64748b; /* Muted gray for subtitle */
}

.close {
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #64748b;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: all 0.2s ease;
    margin-left: 16px;
}

.close:hover {
    background: #e2e8f0;
    color: #475569;
    transform: scale(1.05);
}

/* Special styling untuk cancel modal yang tetap merah */
.modal-header[style*="background: linear-gradient(135deg, #ef4444"] {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    color: white !important;
}

.modal-header[style*="background: linear-gradient(135deg, #ef4444"] .modal-title {
    color: white !important;
}

.modal-header[style*="background: linear-gradient(135deg, #ef4444"] .modal-subtitle {
    color: rgba(255, 255, 255, 0.9) !important;
}

.modal-header[style*="background: linear-gradient(135deg, #ef4444"] .close {
    background: rgba(255, 255, 255, 0.1) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    color: white !important;
}

.modal-header[style*="background: linear-gradient(135deg, #ef4444"] .close:hover {
    background: rgba(255, 255, 255, 0.2) !important;
    color: white !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .modal-header {
        padding: 20px 24px;
    }
    
    .modal-title {
        font-size: 20px;
    }
}

/* Modal Body */
.modal-body {
    padding: 32px;
    max-height: calc(90vh - 200px);
    overflow-y: auto;
}

/* Project Info Card */
.project-info-card {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
}

.project-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
}

.project-title {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.project-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-top: 16px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #64748b;
}

.meta-icon {
    width: 16px;
    height: 16px;
    color: #3b82f6;
}

/* Progress Links Section */
.section {
    margin-bottom: 32px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
}

.section-title {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.section-badge {
    background: #3b82f6;
    color: white;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 20px;
    min-width: 24px;
    text-align: center;
}

/* Links Grid */
.links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 16px;
}

.link-card {
    background: white;
    border: 2px solid #f1f5f9;
    border-radius: 12px;
    padding: 20px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: block;
}

.link-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #3b82f6, #06b6d4);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.link-card:hover {
    border-color: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.15);
    text-decoration: none;
    color: inherit;
}

.link-card:hover::before {
    transform: scaleX(1);
}

.link-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.link-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
}

.link-title {
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.link-subtitle {
    font-size: 12px;
    color: #64748b;
}

.link-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
}

.link-url {
    font-size: 12px;
    color: #64748b;
    font-family: 'Courier New', monospace;
    background: #f8fafc;
    padding: 4px 8px;
    border-radius: 6px;
    flex: 1;
    margin-right: 12px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.link-external {
    color: #3b82f6;
    font-size: 14px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 48px 20px;
    color: #64748b;
}

.empty-icon {
    font-size: 48px;
    color: #cbd5e1;
    margin-bottom: 16px;
}

.empty-title {
    font-size: 18px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
}

.empty-description {
    font-size: 14px;
    max-width: 320px;
    margin: 0 auto;
}

/* Modal Footer */
.modal-footer {
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    padding: 20px 32px;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    border-radius: 0 0 16px 16px;
}

.modal-footer .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
}

.modal-footer .btn-secondary {
    background: #f1f5f9;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

.modal-footer .btn-secondary:hover {
    background: #e2e8f0;
    color: #475569;
}

.modal-footer .btn-primary {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}

.modal-footer .btn-primary:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

/* Scrollbar Styling */
.modal-body::-webkit-scrollbar {
    width: 6px;
}

.modal-body::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.modal-body::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.modal-body::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modal-content {
        margin: 10px;
        max-height: 95vh;
    }
    
    .modal-header {
        padding: 20px 24px;
    }
    
    .modal-body {
        padding: 24px;
    }
    
    .modal-title {
        font-size: 20px;
    }
    
    .links-grid {
        grid-template-columns: 1fr;
    }
    
    .project-meta {
        grid-template-columns: 1fr;
    }
}

        .form-group { 
            margin-bottom: 1.25rem; 
            padding: 0 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.9rem;
        }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-200);
            border-radius: 6px;
            font-size: 0.875rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background: white;
        }

        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: var(--blue-700);
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
        }

        .form-textarea { 
            resize: vertical; 
            min-height: 120px; 
        }

        .submit-button {
            background: var(--green-600);
            color: white;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            font-size: 0.9rem;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .submit-button:hover { 
            background: var(--green-700);
            transform: translateY(-1px);
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--green-600);
            color: white;
            padding: 15px 20px;
            border-radius: 6px;
            box-shadow: var(--shadow-md);
            z-index: 1001;
            display: none;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .notification.show {
            display: block;
            transform: translateX(0);
        }

        .notification.error { background: var(--red-600); }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .status-options {
            display: flex;
            gap: 1rem;
            margin: 20px 0;
            justify-content: center;
            padding: 0 1.5rem;
        }

        .status-option {
            flex: 1;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid transparent;
        }

        .status-option:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .status-accept {
            background: #d1fae5;
            border-color: var(--green-600);
            color: var(--green-700);
        }

        .status-revision {
            background: #fec7c7ff;
            border-color: var(--red-600);
            color: var(--red-700);
        }

        .status-option h3 {
            margin: 0 0 10px 0;
            font-size: 1.1rem;
        }

        .status-option p {
            margin: 0;
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .revision-notes-section {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: #fef3c7;
            border-radius: 8px;
            border-left: 4px solid var(--yellow-600);
        }

        .revision-notes-section.active { display: block; }

        .progress-item {
            border: 1px solid var(--gray-200);
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            background: var(--gray-50);
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .progress-title {
            font-weight: 600;
            color: var(--blue-700);
            margin: 0;
        }

        .progress-date {
            font-size: 0.75rem;
            color: var(--gray-500);
        }

        .progress-description {
            margin-bottom: 12px;
            color: var(--gray-700);
            line-height: 1.5;
        }

        .progress-links {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .link-item {
            background: var(--blue-700);
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .link-item:hover {
            background: var(--blue-800);
        }

        .client-note {
            background: #fef3c7;
            border-left: 4px solid var(--yellow-600);
            padding: 12px;
            margin: 12px 0;
            border-radius: 4px;
        }

        .client-note-title {
            font-weight: 600;
            color: var(--yellow-700);
            margin-bottom: 6px;
        }

        .links-section {
            margin: 20px 0;
        }

        .links-section h4 {
            margin: 0 0 15px 0;
            color: var(--gray-700);
            font-size: 1rem;
            border-bottom: 1px solid var(--gray-200);
            padding-bottom: 8px;
        }

        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .link-item-grid {
            background: var(--blue-700);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }

        .link-item-grid:hover {
            background: var(--blue-800);
            color: white;
            text-decoration: none;
        }

        .submission-info {
            background: #f0f9ff;
            border: 1px solid var(--blue-700);
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .submission-info h4 {
            margin: 0 0 10px 0;
            color: var(--blue-700);
        }

        .submission-info p {
            margin: 0;
            color: var(--gray-700);
            line-height: 1.5;
        }

        .char-counter {
            font-size: 0.75rem;
            color: var(--gray-500);
            text-align: right;
            margin-top: 5px;
        }

        .files-column {
            max-width: 250px;
        }

        .files-list {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            max-height: 120px;
            overflow-y: auto;
        }

        .rating-display {
            cursor: pointer;
            color: var(--yellow-600);
            display: flex;
            align-items: center;
            gap: 0.2rem;
        }

        .rating-display:hover {
            color: var(--yellow-700);
        }

        .rating-modal .modal-content {
            max-width: 500px;
        }

        .star-rating {
            display: flex;
            gap: 0.5rem;
            margin: 20px 0;
            justify-content: center;
        }

        .star {
            font-size: 2rem;
            color: var(--gray-300);
            cursor: pointer;
            transition: color 0.2s;
        }

        .star:hover,
        .star.active {
            color: var(--yellow-600);
        }

        .rating-form {
            text-align: center;
            padding: 0 1.5rem 1.5rem;
        }

        .rating-form textarea {
            width: 100%;
            min-height: 100px;
            margin: 15px 0;
            padding: 12px;
            border: 1px solid var(--gray-200);
            border-radius: 6px;
            resize: vertical;
        }

        .rating-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn-rating {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .btn-rating-submit {
            background: var(--green-600);
            color: white;
        }

        .btn-rating-submit:hover {
            background: var(--green-700);
        }

        .btn-rating-cancel {
            background: var(--gray-500);
            color: white;
        }

        .btn-rating-cancel:hover {
            background: var(--gray-600);
        }

        /* Rating Assessment Section */
        .rating-assessment-section {
            margin: 20px 0;
            padding: 20px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid var(--gray-200);
        }

        .assessment-group {
            margin-bottom: 20px;
        }

        .assessment-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.9rem;
        }

        .assessment-options {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .assessment-option {
            padding: 8px 16px;
            border: 2px solid var(--gray-200);
            border-radius: 20px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .assessment-option:hover {
            border-color: var(--blue-700);
            background: #f0f9ff;
        }

        .assessment-option.selected {
            border-color: var(--blue-700);
            background: var(--blue-700);
            color: white;
        }

        /* Selesai Button Enhancement */
        .status-option-enhanced {
            position: relative;
        }

        .status-option-enhanced .enhancement-preview {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--green-600);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            animation: bounce 0.5s ease-in-out;
        }

        .status-option-enhanced.has-rating .enhancement-preview {
            display: block;
        }

        .char-counter-working {
            font-size: 0.75rem;
            color: var(--gray-500);
            text-align: right;
            margin-top: 5px;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffecb5;
            color: #664d03;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        /* File Upload Styles */
        .files-preview {
            max-height: 200px;
            overflow-y: auto;
            margin-top: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            margin-bottom: 5px;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 4px;
            font-size: 0.75rem;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            min-width: 0;
        }

        .file-icon {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .file-name {
            font-weight: 500;
            color: var(--gray-700);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-size {
            color: var(--gray-500);
            font-size: 0.7rem;
        }

        .file-remove {
            background: var(--red-600);
            color: white;
            border: none;
            border-radius: 3px;
            padding: 2px 6px;
            font-size: 0.7rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .file-remove:hover {
            background: var(--red-700);
        }

        .upload-area:hover {
            border-color: var(--blue-700);
            background: #f0f9ff;
        }

        .upload-area.drag-over {
            border-color: var(--blue-700);
            background: #dbeafe;
            transform: scale(1.02);
        }

        /* Tutorial Modal Styles */
        .tutorial-modal .modal-content {
            max-width: 900px;
            max-height: 90vh;
        }

        .tutorial-content {
            padding: 1.5rem;
        }

        .tutorial-steps {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .tutorial-step {
            padding: 1rem;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            background: var(--gray-50);
        }

        .step-number {
            background: var(--blue-700);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            margin-right: 0.75rem;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 600;
            color: var(--blue-700);
            margin-bottom: 0.25rem;
        }

        .step-description {
            color: var(--gray-700);
            line-height: 1.5;
        }
        .deadline-badge.deadline-late {
            color: #842029;
            background-color: #f5c2c7;
            border: 1px solid #f1aeb5;
        }

        .deadline-badge.deadline-upcoming {
            color: #a51616ff;
            background-color: #fff0f0ff;
            border: 1px solid #e6d7d7ff;
        }

.nav-container {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: -1px;
    z-index: 100;
    width: 100vw;
    
    margin: 0 !important;
    margin-left: -1.5rem !important;
    margin-right: -1.5rem !important;
    margin-top: -1.5rem !important; /* Tambahkan ini untuk menghilangkan gap atas */
    
    padding: 0;
    transition: all 0.3s ease;
}

        .nav-container.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            top: 60px;
        }

        .nav {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-list {
            display: flex;
            list-style: none;
            overflow-x: auto;
            padding: 4px 0;
            gap: 90px;
            scrollbar-width: none;
            -ms-overflow-style: none;
            align-items: center;
            justify-content: center;
            flex-wrap: nowrap;
        }

        .nav-list::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            white-space: nowrap;
            cursor: pointer;
            padding: 8px 20px;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #666;
            background: transparent;
            border: none;
            min-height: 36px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .nav-item:hover, .nav-item.active {
            background: transparent;
            color: #1DA1F2;
            text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
            box-shadow: none;
            transform: translateY(-1px);
        }

        .nav-link {
            text-decoration: none;
            color: inherit;
            display: block;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-item:hover .nav-link,
        .nav-item.active .nav-link {
            color: #1DA1F2;
            text-shadow: 0 0 10px rgba(29, 161, 242, 0.6);
        }
    </style>
</head>

<body>
       <!-- Category Navigation -->
    <div class="nav-container">
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item {{ request()->is('popular*') ? 'active' : '' }}">
                    <a href="/popular" class="nav-link">Pekerjaan Populer</a>
                </li>
                <li class="nav-item {{ request()->is('grafis*') ? 'active' : '' }}">
                    <a href="/grafis" class="nav-link">Grafis & Desain</a>
                </li>
                <li class="nav-item {{ request()->is('dokumen*') ? 'active' : '' }}">
                    <a href="/dokumen" class="nav-link">Dokumen & PPT</a>
                </li>
                <li class="nav-item {{ request()->is('web*') ? 'active' : '' }}">
                    <a href="/web" class="nav-link">Web & App</a>
                </li>
                <li class="nav-item {{ request()->is('video*') ? 'active' : '' }}">
                    <a href="/video" class="nav-link">Video Editing</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Notification -->
    <div id="notification" class="notification">
        <div id="notificationMessage"></div>
    </div>

    <main>
        <h1 style="margin-top: 30px;" class="select-none">Job Board</h1>
        <p class="subtitle">Monitor progress pekerjaan dan kelola hasil dari freelancer Anda.</p>
        
        <!-- Tutorial Button - Moved to top -->
        <div>
            <button class="btn-tutorial" onclick="openTutorialModal()">
                <i class="fas fa-graduation-cap"></i>
                Panduan Client
            </button>
        </div>

        <section class="card">
            <!-- Tabs -->
            <div class="tabs">
                <button type="button" class="tab" data-tab="applied" aria-current="page">Job Board</button>
                <button type="button" class="tab" data-tab="working">Dalam Proses</button>
                <button type="button" class="tab" data-tab="completed">Selesai</button>
                <button type="button" class="tab" data-tab="cancelled">Dibatalkan</button>
            </div>


            <!-- Table: Applied (Open Projects) - Latest first -->
            <div class="table-wrap tab-content" id="applied"> 
                <table class="applied-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Pekerjaan</th>
                            <th>Sub Kategori</th>
                            <th>Freelancer Terpilih</th>
                            <th>Budget (Rp)</th>
                            <th>Tanggal Diposting</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $openProjects = $openProjects->sortBy('created_at');
                            $no = 1; 
                        @endphp
                        @forelse($openProjects as $project)
                            @php
                                $acceptedProposal = $project->proposalls()
                                    ->where('status', 'accepted')
                                    ->with('user')
                                    ->first();
                                $isCompleted = $project->submitProjects()
                                    ->where('status', 'selesai')
                                    ->exists();
                                
                                $hasFreelancer = $acceptedProposal !== null;
                                $isPendingCancellation = $project->cancellation_status === 'pending';
                            @endphp

                            <tr style="{{ $isPendingCancellation ? 'opacity: 0.6; background: #fef3c7;' : '' }}">
                                <td>{{ $no++ }}</td>
                                <td>
                                    {{ $project->title }}
                                    @if($isPendingCancellation)
                                        <span class="status-badge" style="background: #fbbf24; color: #78350f; margin-left: 8px;">
                                            <i class="fas fa-clock"></i> Pengajuan Pembatalan
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $project->subcategory }}</td>
                                <td>
                                    @if($acceptedProposal)
                                        {{ $acceptedProposal->user->name ?? '-' }}
                                    @else
                                        <a href="{{ route('freelancer.show', $project->id) }}" 
                                        style="color: var(--gray-500); text-decoration: underline; cursor: pointer;">
                                            Pilih freelancer
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $project->formatted_budget }}</td>
                                <td>{{ $project->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-detail">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </a>
                                        @if(!$hasFreelancer)
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            
                                        @elseif($isCompleted)
                                            <button class="btn btn-results" onclick="showCompletedTab()">
                                                <i class="fas fa-check-circle"></i> Lihat Hasil
                                            </button>
                                        @else
                                            <button class="btn btn-monitor" onclick="showWorkingTab()">
                                                <i class="fas fa-eye"></i> Pantau Projek
                                            </button>
                                        @endif
                                        @if($isPendingCancellation)
                                            <div class="action-buttons">
                                                <!-- Tombol Setujui (Centang Hijau) -->
                                                <button class="btn btn-success" 
                                                        onclick="handleApproveCancellation({{ $project->id }}, '{{ addslashes($project->title) }}')"
                                                        title="Setujui Pembatalan">
                                                    <i class="fas fa-check"></i> Setujui
                                                </button>
                                                
                                                <!-- Tombol Tolak (Silang Merah) -->
                                                <button class="btn btn-danger" 
                                                        onclick="handleRejectCancellation({{ $project->id }}, '{{ addslashes($project->title) }}')"
                                                        title="Tolak Pembatalan">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            </div>
                                        @else
                                            <div class="action-buttons">

                                            {{-- Jika project sudah selesai --}}
                                            @if($project->status === 'completed')
                                                <span class="status-badge" style="background:#d1fae5; color:#065f46; padding:6px 12px; border-radius:6px;">
                                                    ✔ Selesai
                                                </span>

                                            {{-- Jika belum ada freelancer --}}
                                            @elseif(!$hasFreelancer)
                                                <button class="btn btn-delete" 
                                                        onclick="confirmDeleteProject({{ $project->id }}, '{{ addslashes($project->title) }}')">
                                                    <i class="fas fa-trash"></i> Cancel
                                                </button>

                                            {{-- Jika sudah ada freelancer (project sedang berjalan) --}}
                                            @else
                                                <button class="btn btn-detail" onclick="goToWorkingTab({{ $project->id }})">
                                                    <i class="fas fa-tasks"></i> Pantau Proyek
                                                </button>
                                            @endif

                                        </div>


                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 2rem; color: var(--gray-500);">
                                    Belum ada pekerjaan terbuka
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table: Working Projects - Latest first -->
            <div class="table-wrap tab-content hidden" id="working">
                <table class="working-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Pekerjaan</th>
                            <th>Freelancer</th>
                            <th>Deadline</th>
                            <th>Timeline</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $projects = $projects->sortBy('created_at');
                            $no = 1; 
                        @endphp
                        @foreach($projects as $project)
                            @php
                                $cancellation = \DB::table('project_cancellations')
                                    ->where('project_id', $project->id)
                                    ->first();

                                $showCancelFailed = false;

                                // Jika project dibatalkan:
                                if ($cancellation) {

                                    // Jika refund_status = completed → tampilkan di tab WORKING sebagai "Cancel Gagal"
                                    if ($cancellation->refund_status === 'completed') {
                                        $showCancelFailed = true;
                                    } 
                                    // Selain itu → tetap disembunyikan (cancel sukses / pending)
                                    else {
                                        continue;
                                    }
                                }

                                $acceptedProposal = $project->proposalls()
                                    ->where('status', 'accepted')
                                    ->first();
                                $submitProject = $project->submitProjects()
                                    ->where('user_id', $acceptedProposal->user_id ?? 0)
                                    ->first();
                                $statusDisplay = $submitProject ? match($submitProject->status) {
                                    'pending' => 'Menunggu Persetujuan',
                                    'revisi' => 'Revisi',
                                    default => 'Dalam Proses'
                                } : 'Dalam Proses';
                                $statusClass = $submitProject ? match($submitProject->status) {
                                    'pending' => 'status-pending',
                                    'revisi' => 'status-revision',
                                    default => 'status-working'
                                } : 'status-working';
                                $hasSubmitted = $submitProject && in_array($submitProject->status, ['pending', 'revisi']);
                                
                                // Pastikan deadline di-parse ke Carbon (pakai namespace langsung)
                                $deadline = $project->deadline ? \Carbon\Carbon::parse($project->deadline) : null;

                                if ($deadline) {
                                    if (now()->lessThanOrEqualTo($deadline)) {
                                        $deadlineDays = floor(now()->floatDiffInDays($deadline));
                                        $deadlineText = 'Deadline kurang ' . substr($deadlineDays, 0, 2) . ' hari';
                                    } else {
                                        $deadlineDays = floor($deadline->floatDiffInDays(now()));
                                        $deadlineText = 'Terlambat ' . substr($deadlineDays, 0, 2) . ' hari';
                                    }
                                } else {
                                    $deadlineText = 'Tidak ada deadline';
                                }

                            @endphp

                            @if(!$submitProject || $submitProject->status !== 'selesai')
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $project->title }}</td>
                                <td>{{ optional($acceptedProposal->user)->name ?? '-' }}</td>
                                <td>
                                    <span class="deadline-badge {{ $deadlineDays >= 0 ? 'deadline-upcoming' : 'deadline-late' }}">
                                        {{ $deadlineText }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('timeline', $project->id) }}">Lihat Timeline</a>
                                </td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $statusDisplay }}
                                    </span>
                                </td>
                                <td>
                                    {{ $project->progress ?? 0 }}%
                                    <div class="progress-container">
                                        <div class="progress-bar" style="width: {{ $project->progress ?? 0 }}%"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('chat') }}" class="btn btn-chat">
                                            <i class="fas fa-comments"></i> Chat
                                        </a>
                                        <button class="btn btn-view" onclick="viewProgress({{ $project->id }})">
                                            <i class="fas fa-eye"></i> Lihat Progress
                                        </button>
                                        
                                        @php
                                            $submitProject = $project->submitProjects->first();
                                        @endphp

                                        @if($submitProject && $submitProject->status === 'pending')
                                            <button class="btn btn-accept"
                                                onclick="reviewSubmission({{ $submitProject->id }}, {{ $project->id }})">
                                                Setujui / Revisi
                                            </button>
                                        @elseif($hasSubmitted && $submitProject->status === 'revisi')
                                            <button class="btn btn-edit-notes" onclick="editNotes({{ $submitProject->id }})">
                                                <i class="fas fa-edit"></i> Edit Notes
                                            </button>
                                        @endif
                                        
                                        @if($showCancelFailed)
                                            <button class="btn" style="background:#dc3545; color:white; cursor:default;">
                                                <i class="fas fa-times-circle"></i> Cancel Gagal
                                            </button>
                                        @endif

                                        {{-- PERBAIKAN: Tambahkan parameter true untuk working project --}}
                                        <button class="btn btn-delete" 
                                                onclick="openCancelModal({{ $project->id }}, '{{ addslashes($project->title) }}', true)">
                                            <i class="fas fa-trash"></i> Cancel
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endif

                            <!-- Modal Cancel for Working Projects -->
                            <div class="modal fade" id="cancelWorkingModal-{{ $project->id }}" tabindex="-1" aria-labelledby="cancelWorkingModalLabel-{{ $project->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="cancelWorkingModalLabel-{{ $project->id }}">
                                                <i class="fas fa-exclamation-triangle"></i> Cancel Projek: {{ $project->title }}
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-warning" role="alert">
                                                <i class="fas fa-info-circle"></i>
                                                <strong>Peringatan:</strong> Membatalkan projek ini akan menghentikan semua progress dan tidak dapat dikembalikan.
                                            </div>
                                            <form id="cancelWorkingForm-{{ $project->id }}">
                                                <div class="mb-3">
                                                    <label for="workingReason-{{ $project->id }}" class="form-label">
                                                        <strong>Alasan pembatalan:</strong> <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea id="workingReason-{{ $project->id }}" class="form-control" rows="4" 
                                                            placeholder="Jelaskan alasan pembatalan projek ini..." required></textarea>
                                                    <div class="form-text">Minimal 10 karakter diperlukan</div>
                                                    <div class="char-counter-working">
                                                        Karakter: <span id="workingCharCount-{{ $project->id }}">0</span>/500
                                                    </div>
                                                </div>
                                                
                                                <!-- Project Info -->
                                                <div class="mb-3 p-3 bg-light rounded">
                                                    <h6><i class="fas fa-info-circle"></i> Informasi Projek:</h6>
                                                    <p class="mb-1"><strong>Freelancer:</strong> {{ optional($acceptedProposal->user)->name ?? 'Tidak ada' }}</p>
                                                    <p class="mb-1"><strong>Progress:</strong> {{ $project->progress ?? 0 }}%</p>
                                                    <p class="mb-1"><strong>Deadline:</strong> {{ $deadlineText }}</p>
                                                    <p class="mb-0"><strong>Status:</strong> {{ $statusDisplay }}</p>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-arrow-left"></i> Kembali
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="submitWorkingCancel({{ $project->id }})">
                                                <i class="fas fa-ban"></i> Ya, Batalkan Projek
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table: Completed Projects - Latest first -->
            <div class="table-wrap tab-content hidden" id="completed">
                <table class="completed-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Pekerjaan</th>
                            <th>Freelancer</th>
                            <th>Total Bayar</th>
                            <th>Tanggal Selesai</th>
                            <th>Rating</th>
                            <th>File Progress</th>
                            <th>File Hasil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $completed = $completed->sortBy('updated_at');
                        @endphp
                        @forelse($completed as $index => $submission)
                            @php

                                $acceptedProposal = $submission->project->proposalls()
                                    ->where('status', 'accepted')
                                    ->first();
                                
                                // Get progress files dari tabel progress_uploads menggunakan DB query
                                $progressFiles = \DB::table('progress_uploads')
                                    ->where('project_id', $submission->project->id)
                                    ->whereNotNull('link_url')
                                    ->where('link_url', '!=', '')
                                    ->pluck('link_url')
                                    ->toArray();
                                
                                // Get result files from submit_projects table (links column)
                                $resultFiles = [];
                                if (!empty($submission->links)) {
                                    if (is_string($submission->links)) {
                                        // Try to decode JSON first
                                        $decodedLinks = json_decode($submission->links, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedLinks)) {
                                            $resultFiles = $decodedLinks;
                                        } else {
                                            // If not JSON, treat as newline-separated string
                                            $resultFiles = array_filter(array_map('trim', explode("\n", $submission->links)));
                                        }
                                    } elseif (is_array($submission->links)) {
                                        $resultFiles = $submission->links;
                                    }
                                }
                                
                                // Sample ratings for demo
                                $sampleRatings = [4.5, 5.0, 4.2, 4.8, 3.9];
                                $currentRating = $sampleRatings[$index % count($sampleRatings)];
                            @endphp
                            <tr data-project-id="{{ $submission->project->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $submission->project->title ?? '-' }}</td>
                                <td>{{ $submission->user->name ?? '-' }}</td>
                                <td>
                                    Rp {{ number_format($acceptedProposal->proposal_price ?? 0, 0, ',', '.') }}
                                </td>
                                <td>{{ $submission->updated_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="rating-display" onclick="openRatingModal({{ $submission->project->id }}, {{ $currentRating }})">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star" style="color: {{ $i <= $currentRating ? 'var(--yellow-600)' : 'var(--gray-300)' }};"></i>
                                        @endfor
                                        <span style="margin-left: 0.3rem; font-size: 0.75rem;">({{ $currentRating }})</span>
                                    </div>
                                </td>
                                <!-- File Progress Column -->
                                <td class="files-column">
                                    <div class="files-list">
                                        @if(!empty($progressFiles))
                                            @foreach($progressFiles as $progressIndex => $progressFile)
                                                @if(filter_var($progressFile, FILTER_VALIDATE_URL))
                                                    <a href="{{ $progressFile }}" class="btn btn-drive" target="_blank">
                                                        <i class="fab fa-google-drive"></i> File {{ $progressIndex + 1 }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        @else
                                            <span style="color: var(--gray-500); font-size: 0.75rem;">Tidak ada file progress</span>
                                        @endif
                                    </div>
                                </td>
                                <!-- File Hasil Column -->
                                <td class="files-column">
                                    @if(!empty($resultFiles))
                                        <div class="files-list">
                                            @foreach($resultFiles as $linkIndex => $link)
                                                @if(filter_var($link, FILTER_VALIDATE_URL))
                                                    <a href="{{ $link }}" class="btn btn-drive" target="_blank">
                                                        <i class="fab fa-google-drive"></i> File {{ $linkIndex + 1 }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <span style="color: var(--gray-500); font-size: 0.75rem;">Tidak ada file hasil</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('projects.show', $submission->project->id) }}" class="btn btn-detail">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="text-align: center; padding: 2rem; color: var(--gray-500);">
                                    Belum ada project yang selesai
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table: Cancelled Projects -->
<div class="table-wrap tab-content hidden" id="cancelled">
    <table class="completed-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Pekerjaan</th>
                <th>Freelancer</th>
                <th>Alasan Pembatalan</th>
                <th>Tanggal Dibatalkan</th>
                <th>Refund Amount</th>
                <th>Status Refund</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cancelledProjects as $index => $cancel)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $cancel->project->title }}</td>

                    <td>
                        {{ $cancel->project->proposalls()
                            ->where('status', 'accepted')
                            ->first()
                            ?->user?->name ?? '-' 
                        }}
                    </td>

                    <td>
                        <span style="font-size: 0.75rem;">
                            {{ Str::limit($cancel->reason, 50) }}
                        </span>
                    </td>

                    <td>{{ $cancel->cancelled_at?->format('d/m/Y') }}</td>

                    <td>Rp {{ number_format($cancel->refund_amount, 0, ',', '.') }}</td>

                    <td>
                        @if($cancel->refund_status === 'processed')
                            <span class="status-badge status-processed">berhasil dibatalkan</span>

                        @elseif($cancel->refund_status === 'pending')
                            <span class="status-badge status-pending">menunggu persetujuan admin</span>

                        @else
                            <span class="status-badge">-</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('projects.show', $cancel->project->id) }}" class="btn btn-detail">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2rem; color: var(--gray-500);">
                        Tidak ada project yang dibatalkan
                    </td>
                </tr>
                @endforelse

        </tbody>
    </table>
</div>
        </section>
    </main>

<!-- COMPLETE MODAL HTML STRUCTURE -->

<!-- Progress Modal -->
<div id="progressModal" class="modal">
    <div class="modal-content">
        <div id="progressContent">
            <!-- Content will be loaded dynamically by JavaScript -->
        </div>
    </div>
</div>

<!-- Review Submission Modal -->
<div id="reviewSubmissionModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-clipboard-check"></i>
                    Review Submission
                </h2>
                <p class="modal-subtitle">Tinjau hasil kerja dari freelancer</p>
            </div>
            <span class="close" onclick="closeModal('reviewSubmissionModal')">×</span>
        </div>
        <div class="modal-body">
            <div id="reviewSubmissionContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Edit Notes Modal -->
<div id="editNotesModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Edit Revision Notes
                </h2>
                <p class="modal-subtitle">Perbarui catatan revisi untuk freelancer</p>
            </div>
            <span class="close" onclick="closeModal('editNotesModal')">×</span>
        </div>
        <div class="modal-body">
            <form id="editNotesForm">
                <input type="hidden" id="editSubmissionId" name="submission_id">
                <div class="form-group">
                    <label class="form-label" for="editRevisionNotes">Catatan Revisi (min. 10 karakter)</label>
                    <textarea id="editRevisionNotes" class="form-textarea" name="notes" rows="5" required></textarea>
                    <div class="char-counter">Karakter: <span id="editCharCount">0</span>/1000</div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('editNotesModal')">
                <i class="fas fa-times"></i>
                Batal
            </button>
            <button type="submit" form="editNotesForm" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Update Notes
            </button>
        </div>
    </div>
</div>

<!-- Rating Modal -->
<div id="ratingModal" class="modal rating-modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-star"></i>
                    Beri Rating & Review
                </h2>
                <p class="modal-subtitle">Bagaimana pengalaman Anda dengan freelancer ini?</p>
            </div>
            <span class="close" onclick="closeModal('ratingModal')">×</span>
        </div>
        <div class="modal-body">
            <div class="rating-form">
                <div class="star-rating" id="starRating">
                    <i class="fas fa-star star" data-rating="1"></i>
                    <i class="fas fa-star star" data-rating="2"></i>
                    <i class="fas fa-star star" data-rating="3"></i>
                    <i class="fas fa-star star" data-rating="4"></i>
                    <i class="fas fa-star star" data-rating="5"></i>
                </div>
                <p id="ratingText" style="margin: 10px 0; font-weight: 600; color: #3b82f6;">Pilih rating</p>
                
                <!-- Rating Assessment Section -->
                <div class="rating-assessment-section">
                    <div class="assessment-group">
                        <label class="assessment-label">Ketepatan Waktu</label>
                        <div class="assessment-options" data-assessment="timeliness">
                            <div class="assessment-option" data-value="excellent">Excellent</div>
                            <div class="assessment-option" data-value="good">Good</div>
                            <div class="assessment-option" data-value="fair">Fair</div>
                            <div class="assessment-option" data-value="poor">Poor</div>
                        </div>
                    </div>
                    
                    <div class="assessment-group">
                        <label class="assessment-label">Kualitas Kerja</label>
                        <div class="assessment-options" data-assessment="quality">
                            <div class="assessment-option" data-value="outstanding">Outstanding</div>
                            <div class="assessment-option" data-value="excellent">Excellent</div>
                            <div class="assessment-option" data-value="good">Good</div>
                            <div class="assessment-option" data-value="satisfactory">Satisfactory</div>
                            <div class="assessment-option" data-value="needs-improvement">Needs Improvement</div>
                        </div>
                    </div>
                </div>
                
                <textarea id="reviewText" placeholder="Tulis review Anda di sini... (opsional)" rows="4" class="form-textarea" style="margin-top: 16px;"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('ratingModal')">
                <i class="fas fa-times"></i>
                Batal
            </button>
            <button class="btn btn-primary" onclick="submitRating()">
                <i class="fas fa-paper-plane"></i>
                Kirim Rating
            </button>
        </div>
    </div>
</div>

<!-- Tutorial Modal -->
<div id="tutorialModal" class="modal tutorial-modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-graduation-cap"></i>
                    Panduan Penggunaan Job Board
                </h2>
                <p class="modal-subtitle">Pelajari cara menggunakan platform dengan efektif</p>
            </div>
            <span class="close" onclick="closeModal('tutorialModal')">×</span>
        </div>
        <div class="modal-body">
            <div class="tutorial-content">
                <div class="tutorial-steps">
                    <div class="tutorial-step">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <div class="step-title">Buat Project Baru</div>
                                <div class="step-description">
                                    Klik tombol "Buat Project Baru" untuk memulai. Isi detail pekerjaan, kategori, budget, dan timeline yang diperlukan.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tutorial-step">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <div class="step-title">Pilih Freelancer</div>
                                <div class="step-description">
                                    Di tab "Job Board", klik "Pilih freelancer" untuk melihat proposal yang masuk. Pilih freelancer terbaik berdasarkan portofolio dan harga.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tutorial-step">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <div class="step-title">Monitor Progress</div>
                                <div class="step-description">
                                    Pindah ke tab "Sedang Dikerjakan" untuk memantau progress. Klik "Pantau Proyek" untuk melihat update file dan milestone yang dicapai.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tutorial-step">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <div class="step-title">Review & Rating</div>
                                <div class="step-description">
                                    Ketika freelancer mengirimkan hasil akhir, review submission di tab "Sedang Dikerjakan". Berikan rating dan review di tab "Selesai".
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tutorial-step">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <div class="step-number">5</div>
                            <div class="step-content">
                                <div class="step-title">Kelola Pembayaran</div>
                                <div class="step-description">
                                    Pembayaran akan diproses otomatis setelah Anda menyetujui hasil akhir. Dana akan dilepaskan ke freelancer setelah rating diberikan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; text-align: center;">
                    <p style="color: #64748b; font-size: 0.9rem;">
                        <i class="fas fa-lightbulb" style="color: #f59e0b; margin-right: 0.5rem;"></i>
                        <strong>Tip:</strong> Selalu komunikasikan ekspektasi yang jelas di awal untuk hasil yang lebih baik!
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" onclick="closeModal('tutorialModal')" style="width: 100%;">
                <i class="fas fa-check"></i>
                Mengerti, Tutup Panduan
            </button>
        </div>
    </div>
</div>

<!-- MODAL CANCEL OPEN PROJECT -->
<div id="cancelOpenModal" class="modal">
    <div class="modal-content" style="max-width: 600px;">
        <div class="modal-header" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Batalkan Project
                </h2>
                <p class="modal-subtitle">Isi alasan pembatalan dan informasi refund</p>
            </div>
            <span class="close" onclick="closeModal('cancelOpenModal')">×</span>
        </div>

        <div class="modal-body">
            <form id="cancelOpenForm" enctype="multipart/form-data">
                <input type="hidden" id="cancelOpenProjectId" name="project_id">

                <!-- Alasan Pembatalan -->
                <div class="form-group">
                    <label for="cancelOpenReason" class="form-label">
                        <strong>Alasan Pembatalan:</strong> <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea
                        id="cancelOpenReason"
                        name="reason"
                        class="form-control"
                        rows="4"
                        placeholder="Jelaskan alasan pembatalan project ini (minimal 10 karakter)"
                        required
                        minlength="10"
                        maxlength="500"></textarea>
                    <small style="color: #6b7280; font-size: 12px;">
                        <span id="cancelOpenReasonCount">0</span>/500 karakter
                    </small>
                </div>

                <!-- Informasi Bank -->
                <div class="form-group">
                    <label for="cancelOpenBankName" class="form-label">
                        <strong>Nama Bank:</strong> <span style="color: #ef4444;">*</span>
                    </label>
                    <select id="cancelOpenBankName" name="bank_name" class="form-control" required>
                        <option value="">Pilih Bank</option>
                        <option value="BCA">BCA</option>
                        <option value="MANDIRI">Mandiri</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="CIMB">CIMB Niaga</option>
                        <option value="PERMATA">Permata</option>
                        <option value="DANAMON">Danamon</option>
                        <option value="BTN">BTN</option>
                        <option value="BSI">BSI (Bank Syariah Indonesia)</option>
                        <option value="GOPAY">GoPay</option>
                        <option value="OVO">OVO</option>
                        <option value="DANA">DANA</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cancelOpenAccountNumber" class="form-label">
                        <strong>Nomor Rekening:</strong> <span style="color: #ef4444;">*</span>
                    </label>
                    <input
                        type="text"
                        id="cancelOpenAccountNumber"
                        name="account_number"
                        class="form-control"
                        placeholder="Contoh: 1234567890"
                        required
                        pattern="[0-9]+"
                        maxlength="20">
                    <small style="color: #6b7280; font-size: 12px;">Hanya angka tanpa spasi atau tanda baca</small>
                </div>

                <!-- ✅ CHECKBOX POSTING ULANG PROYEK -->
<div class="form-group" style="margin-top: 20px; padding: 15px; background: #f0fdf4; border: 1px solid #d1fae5; border-radius: 8px;">
    <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer; margin: 0;">
        <input 
            type="checkbox" 
            id="repostProject" 
            name="repost_project" 
            value="1"
            style="margin-top: 2px; width: 18px; height: 18px; cursor: pointer;">
        <span style="flex: 1; font-size: 14px; color: #065f46;">
            <strong>Posting ulang proyek ini setelah dibatalkan</strong>
            <br>
            <small style="color: #047857;">Proyek akan otomatis di-posting kembali setelah pembatalan disetujui admin</small>
        </span>
    </label>
</div>

                <!-- Upload Evidence (Optional) -->
                <div class="form-group">
                    <label for="cancelOpenEvidence" class="form-label">
                        <strong>Upload Bukti Pendukung:</strong> <span style="color: #9ca3af;">(Opsional)</span>
                    </label>
                    <input
                        type="file"
                        id="cancelOpenEvidence"
                        name="evidence_files[]"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt"
                        multiple>
                    <small style="color: #6b7280; font-size: 12px;">
                        Format: JPG, PNG, PDF, DOC, DOCX, TXT (Max. 5MB per file)
                    </small>
                    <div id="cancelOpenFileList" style="margin-top: 10px;"></div>
                </div>

                <!-- Info Warning -->
                <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 12px; border-radius: 6px; margin-top: 15px;">
                    <p style="margin: 0; font-size: 13px; color: #92400e;">
                        <i class="fas fa-info-circle" style="color: #f59e0b;"></i>
                        <strong>Perhatian:</strong> Pengajuan pembatalan akan diproses oleh admin dalam 1-2 hari kerja.
                    </p>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('cancelOpenModal')">
                <i class="fas fa-times"></i>
                Batal
            </button>
            <button type="button" class="btn btn-danger" onclick="submitCancelOpen()">
                <i class="fas fa-paper-plane"></i>
                Kirim Pengajuan
            </button>
        </div>
    </div>
</div>

<!-- Cancel Modal for Working Projects - COMPACT VERSION -->
<div id="cancelWorkingModal" class="modal">
    <div class="modal-content">
        <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-ban"></i>
                    Cancel Projek yang Sedang Dikerjakan
                </h2>
                <p class="modal-subtitle">Peringatan: Akan menghentikan semua progress dan refund sebagian dana</p>
            </div>
            <span class="close" onclick="closeModal('cancelWorkingModal')">×</span>
        </div>
        
        <div class="modal-body">
            <!-- ✅ WARNING BOX - COMPACT -->
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 12px; margin-bottom: 20px; border-radius: 6px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-exclamation-triangle" style="color: #ef4444; font-size: 14px;"></i>
                    <strong style="color: #dc2626; font-size: 13px;">Peringatan Penting:</strong>
                </div>
                <p style="color: #991b1b; margin: 6px 0 0 0; font-size: 12px; line-height: 1.4;">
                    Membatalkan projek yang sedang dikerjakan akan menghentikan semua progress. 
                    Refund tidak akan dikembalikan penuh, karena kebijakan website kami.
                </p>
            </div>

            <!-- FORM COMPACT -->
            <form id="cancelWorkingForm">
                <input type="hidden" id="cancelWorkingProjectId" name="project_id">
                
                <!-- ✅ ALASAN PEMBATALAN - COMPACT -->
                <div style="margin-bottom: 20px; padding: 0 1.5rem;">
                    <label for="cancelWorkingReason" class="form-label" style="display: block; margin-bottom: 6px;">
                        <strong style="font-size: 13px;">Alasan pembatalan:</strong> <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea 
                        id="cancelWorkingReason" 
                        name="reason"
                        class="form-textarea" 
                        rows="3"
                        placeholder="Jelaskan alasan pembatalan projek ini..." 
                        required
                        minlength="10"
                        maxlength="500"
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 13px; resize: vertical;"></textarea>
                    <div style="display: flex; justify-content: space-between; margin-top: 4px;">
                        <div style="font-size: 11px; color: #6b7280;">Minimal 10 karakter</div>
                        <div class="char-counter" style="font-size: 11px; color: #9ca3af;">
                            <span id="cancelWorkingCharCount">0</span>/500
                        </div>
                    </div>
                </div>

                <!-- ✅ UPLOAD BUKTI - COMPACT -->
                <div style="margin-bottom: 20px; padding: 0 1.5rem;">
                    <label for="cancelEvidenceFilesWorking" class="form-label" style="display: block; margin-bottom: 6px;">
                        <strong style="font-size: 13px;">Upload Bukti (Opsional):</strong>
                    </label>
                    <div 
                        style="border: 2px dashed #d1d5db; border-radius: 6px; padding: 12px; text-align: center; background: #f9fafb; cursor: pointer; transition: all 0.3s;" 
                        onclick="document.getElementById('cancelEvidenceFilesWorking').click()"
                        id="cancelDropZoneWorking">
                        <input 
                            type="file" 
                            id="cancelEvidenceFilesWorking" 
                            name="evidence_files[]" 
                            multiple 
                            accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.txt" 
                            style="display: none;">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 1.5rem; color: #3b82f6; margin-bottom: 6px;"></i>
                        <p style="margin: 0; color: #3b82f6; font-weight: 600; font-size: 13px;">Klik untuk upload file bukti</p>
                        <p style="margin: 4px 0 0 0; font-size: 11px; color: #6b7280;">
                            Gambar, PDF, DOC - Max 5MB/file
                        </p>
                    </div>
                    <div id="cancelFileListWorking" class="files-preview" style="margin-top: 8px;"></div>
                </div>

                <!-- ✅ BANK SELECT - COMPACT -->
                <div style="margin-bottom: 16px; padding: 0 1.5rem;">
                    <label for="bankSelectWorking" class="form-label" style="display: block; margin-bottom: 6px;">
                        <strong style="font-size: 13px;">Pilih Bank:</strong> <span style="color: #ef4444;">*</span>
                    </label>
                    <select id="bankSelectWorking" name="bank_name" class="form-select" required style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 13px; background: white;">
                        <option value="" disabled selected>Pilih Bank</option>
                        <option value="bca">BCA</option>
                        <option value="mandiri">Mandiri</option>
                        <option value="bni">BNI</option>
                        <option value="bri">BRI</option>
                        <option value="cimb">CIMB Niaga</option>
                        <option value="danamon">Danamon</option>
                        <option value="permata">Permata</option>
                        <option value="bsi">BSI (Bank Syariah Indonesia)</option>
                    </select>
                </div>

                <!-- ✅ NOMOR REKENING - COMPACT -->
                <div style="margin-bottom: 20px; padding: 0 1.5rem;">
                    <label for="accountNumberWorking" class="form-label" style="display: block; margin-bottom: 6px;">
                        <strong style="font-size: 13px;">Nomor Rekening:</strong> <span style="color: #ef4444;">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="accountNumberWorking" 
                        name="account_number"
                        class="form-input" 
                        placeholder="Contoh: 1234567890" 
                        required 
                        pattern="[0-9]+" 
                        title="Hanya angka yang diperbolehkan"
                        style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 13px;">
                    <div style="font-size: 11px; color: #6b7280; margin-top: 4px;">Masukkan nomor rekening untuk pengembalian dana</div>
                </div>
                
                <!-- ✅ CHECKBOX POSTING ULANG PROYEK - WORKING -->
<div style="margin-bottom: 20px; padding: 0 1.5rem;">
    <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer; margin: 0; padding: 12px; background: #f0fdf4; border: 1px solid #d1fae5; border-radius: 8px;">
        <input 
            type="checkbox" 
            id="repostProjectWorking" 
            name="repost_project" 
            value="1"
            style="margin-top: 2px; width: 18px; height: 18px; cursor: pointer;">
        <span style="flex: 1; font-size: 13px; color: #065f46;">
            <strong>Posting ulang proyek ini setelah dibatalkan</strong>
            <br>
            <small style="color: #047857;">Proyek akan otomatis di-posting kembali setelah pembatalan disetujui admin</small>
        </span>
    </label>
</div>

                <!-- ✅ PROJECT PROGRESS INFO - COMPACT -->
                <div class="project-info-card" style="margin-bottom: 0;">
                    <h4 style="margin: 0 0 10px 0; color: #1e293b; display: flex; align-items: center; gap: 6px; font-size: 14px;">
                        <i class="fas fa-chart-line" style="color: #3b82f6; font-size: 13px;"></i> 
                        Progress Saat Ini
                    </h4>
                    <div class="project-meta">
                        <div class="meta-item" style="padding: 6px 0;">
                            <i class="fas fa-user meta-icon" style="font-size: 12px;"></i>
                            <span style="font-size: 12px;"><strong>Freelancer:</strong> <span id="cancelWorkingFreelancer">-</span></span>
                        </div>
                        <div class="meta-item" style="padding: 6px 0;">
                            <i class="fas fa-percentage meta-icon" style="font-size: 12px;"></i>
                            <span style="font-size: 12px;"><strong>Progress:</strong> <span id="cancelWorkingProgress">0%</span></span>
                        </div>
                        <div class="meta-item" style="padding: 6px 0;">
                            <i class="fas fa-calendar meta-icon" style="font-size: 12px;"></i>
                            <span style="font-size: 12px;"><strong>Deadline:</strong> <span id="cancelWorkingDeadline">-</span></span>
                        </div>
                        <div class="meta-item" style="padding: 6px 0; border-bottom: none;">
                            <i class="fas fa-info-circle meta-icon" style="font-size: 12px;"></i>
                            <span style="font-size: 12px;"><strong>Status:</strong> <span id="cancelWorkingStatus">-</span></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('cancelWorkingModal')" style="padding: 8px 16px; font-size: 13px;">
                <i class="fas fa-arrow-left"></i> 
                Kembali
            </button>
            <button type="button" class="btn btn-danger" onclick="submitWorkingCancel()" style="padding: 8px 16px; font-size: 13px;">
                <i class="fas fa-ban"></i> 
                Ya, Batalkan Projek
            </button>
        </div>
    </div>
</div>

    <script>

        console.log('🔍 DEBUG: Project Status Check');
// ============================================
// COMPLETE JOBBOARD CLIENT JAVASCRIPT - FINAL VERSION
// ============================================

// Global variables
let currentSubmissionId = null;
let currentProjectId = null;
let currentRatingProjectId = null;
let selectedRating = 0;
let selectedAssessments = {};
let currentCancelProject = null;
let cancelEvidenceFiles = [];

// ============================================
// TAB FUNCTIONALITY
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.removeAttribute('aria-current'));
            tab.setAttribute('aria-current', 'page');
            contents.forEach(c => c.classList.add('hidden'));
            document.getElementById(tab.dataset.tab).classList.remove('hidden');
        });
    });
});

function showWorkingTab() {
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(t => t.removeAttribute('aria-current'));
    document.querySelector('[data-tab="working"]').setAttribute('aria-current', 'page');
    contents.forEach(c => c.classList.add('hidden'));
    document.getElementById('working').classList.remove('hidden');
}

function showCompletedTab() {
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(t => t.removeAttribute('aria-current'));
    document.querySelector('[data-tab="completed"]').setAttribute('aria-current', 'page');
    contents.forEach(c => c.classList.add('hidden'));
    document.getElementById('completed').classList.remove('hidden');
}

function goToWorkingTab(projectId) {
    document.querySelector('[data-tab="working"]').click();
    setTimeout(() => {
        const row = document.querySelector(`#working tr[data-project-id="${projectId}"]`);
        if (row) {
            row.style.background = "#fef9c3";
            row.scrollIntoView({ behavior: "smooth", block: "center" });
            setTimeout(() => row.style.background = "", 2000);
        }
    }, 300);
}

// ============================================
// MODAL FUNCTIONS
// ============================================
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';
        
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
        
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
        
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }
}

// Close modal on outside click
document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal(modal.id);
            }
        });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModals = document.querySelectorAll('.modal.show');
            openModals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
});

// ============================================
// NOTIFICATION SYSTEM
// ============================================
function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    const messageEl = document.getElementById('notificationMessage');
    
    if (!notification || !messageEl) {
        console.warn('Notification elements not found');
        return;
    }

    messageEl.innerHTML = message;
    notification.className = `notification show ${type}`;
    
    setTimeout(() => {
        notification.classList.remove('show');
    }, 5000);
}

// ============================================
// PROGRESS MODAL
// ============================================
function viewProgress(projectId) {
    currentProjectId = projectId;
    const progressContent = document.getElementById('progressContent');

    progressContent.innerHTML = `
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-chart-line"></i>
                    Progress Details
                </h2>
                <p class="modal-subtitle">Memuat detail progress...</p>
            </div>
            <span class="close" onclick="closeModal('progressModal')">×</span>
        </div>
        <div class="modal-body">
            <div style="text-align: center; padding: 40px; color: #64748b;">
                <i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 15px; color: #3b82f6;"></i>
                <p>Memuat progress...</p>
            </div>
        </div>
    `;
    openModal('progressModal');

    fetch(`/submit-projects/status/${projectId}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        return response.json();
    })
    .then(data => {
        let content = `
            <div class="modal-header">
                <div class="modal-title-section">
                    <h2 class="modal-title">
                        <i class="fas fa-chart-line"></i>
                        Progress Details
                    </h2>
                    <p class="modal-subtitle">Pantau perkembangan pekerjaan</p>
                </div>
                <span class="close" onclick="closeModal('progressModal')">×</span>
            </div>
            <div class="modal-body">
                <div class="project-info-card">
                    <h3 class="project-title">
                        <i class="fas fa-project-diagram"></i>
                        ${data.project.title}
                    </h3>
                    <div class="project-meta">
                        <div class="meta-item">
                            <i class="fas fa-file-alt meta-icon"></i>
                            <span><strong>Total Files:</strong> ${data.total_links || 0}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-user meta-icon"></i>
                            <span><strong>Status:</strong> Dalam Progress</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar meta-icon"></i>
                            <span><strong>Last Update:</strong> ${new Date().toLocaleDateString('id-ID')}</span>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">
                        <i class="fas fa-tasks" style="color: #3b82f6; font-size: 20px;"></i>
                        <h3 class="section-title">Progress Links</h3>
                        <span class="section-badge">${data.links ? data.links.length : 0}</span>
                    </div>
        `;

        if (data.links && data.links.length > 0) {
            content += `<div class="links-grid">`;
            data.links.forEach((link, index) => {
                let iconClass = 'fas fa-external-link-alt';
                let iconBg = 'linear-gradient(135deg, #3b82f6, #2563eb)';
                
                if (link.url.includes('drive.google.com')) {
                    iconClass = 'fab fa-google-drive';
                    iconBg = 'linear-gradient(135deg, #10b981, #059669)';
                }

                content += `
                    <a href="${link.url}" class="link-card" target="_blank">
                        <div class="link-header">
                            <div class="link-icon" style="background: ${iconBg};">
                                <i class="${iconClass}"></i>
                            </div>
                            <div>
                                <div class="link-title">Progress Link #${index + 1}</div>
                                <div class="link-subtitle">Klik untuk membuka</div>
                            </div>
                        </div>
                        <div class="link-footer">
                            <div class="link-url">${link.url.substring(0, 40)}${link.url.length > 40 ? '...' : ''}</div>
                            <i class="fas fa-arrow-up-right-from-square link-external"></i>
                        </div>
                    </a>
                `;
            });
            content += `</div>`;
        } else {
            content += `
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                    <h4 class="empty-title">Belum ada Progress Links</h4>
                    <p class="empty-description">Freelancer belum mengupload link progress.</p>
                </div>
            `;
        }

        content += `
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('progressModal')">
                    <i class="fas fa-times"></i> Tutup
                </button>
                <a href="${data.chat_url || '/chat'}" class="btn btn-primary">
                    <i class="fas fa-comments"></i> Chat Freelancer
                </a>
            </div>
        `;
        
        progressContent.innerHTML = content;
    })
    .catch(error => {
        progressContent.innerHTML = `
            <div class="modal-header">
                <div class="modal-title-section">
                    <h2 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Error Loading Progress
                    </h2>
                </div>
                <span class="close" onclick="closeModal('progressModal')">×</span>
            </div>
            <div class="modal-body">
                <div class="empty-state">
                    <div class="empty-icon" style="color: #ef4444;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h4 class="empty-title">Error</h4>
                    <p class="empty-description">${error.message}</p>
                </div>
            </div>
        `;
        showNotification('Gagal memuat progress', 'error');
    });
}

// ============================================
// REVIEW SUBMISSION MODAL
// ============================================
function reviewSubmission(submissionId, projectId) {
    console.log('📝 reviewSubmission called:', { submissionId, projectId });
    
    currentSubmissionId = submissionId;
    currentProjectId = projectId;
    const reviewContent = document.getElementById('reviewSubmissionContent');

    reviewContent.innerHTML = `
        <div style="text-align: center; padding: 40px;">
            <i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #3b82f6;"></i>
            <p>Loading submission details...</p>
        </div>
    `;
    openModal('reviewSubmissionModal');

    Promise.all([
        fetch(`/submit-projects/status/${projectId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        }),
        fetch(`/submit-projects/${submissionId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
    ])
    .then(responses => Promise.all(responses.map(r => {
        if (!r.ok) throw new Error(`HTTP ${r.status}`);
        return r.json();
    })))
    .then(([progressData, submissionData]) => {
        let content = `
            <div class="submission-info">
                <h4><i class="fas fa-info-circle"></i> Informasi Submission</h4>
                <p><strong>Deskripsi:</strong> ${submissionData.description || 'Tidak ada deskripsi'}</p>
                ${submissionData.notes ? `<p><strong>Catatan:</strong> ${submissionData.notes}</p>` : ''}
            </div>

            <div class="links-section">
                <h4><i class="fas fa-tasks"></i> Progress Links (${progressData.total_links || 0})</h4>
        `;
        
        if (progressData.links && progressData.links.length > 0) {
            content += `<div class="links-grid">`;
            progressData.links.forEach((link, index) => {
                content += `
                    <a href="${link.url}" class="link-item-grid" target="_blank">
                        <i class="fas fa-link"></i> Progress Link #${index + 1}
                    </a>
                `;
            });
            content += `</div>`;
        } else {
            content += `<p style="color: var(--gray-500); text-align: center; padding: 20px;">Tidak ada progress links</p>`;
        }
        content += `</div>`;

        content += `<div class="links-section">`;
        content += `<h4><i class="fas fa-upload"></i> Submission Links (${submissionData.links ? submissionData.links.length : 0})</h4>`;
        
        if (submissionData.links && submissionData.links.length > 0) {
            content += `<div class="links-grid">`;
            submissionData.links.forEach((link, index) => {
                content += `
                    <a href="${link}" class="link-item-grid" target="_blank">
                        <i class="fas fa-file"></i> Submission Link #${index + 1}
                    </a>
                `;
            });
            content += `</div>`;
        } else {
            content += `<p style="color: var(--gray-500); text-align: center; padding: 20px;">Tidak ada submission links</p>`;
        }
        content += `</div>`;

        content += `
            <div class="status-options">
                <div class="status-option status-accept" onclick="handleSelesaiClick(${submissionId})">
                    <h3><i class="fas fa-check"></i> Selesai</h3>
                    <p>Terima submission dan tandai project selesai</p>
                </div>
                <div class="status-option status-revision" onclick="showRevisionForm()">
                    <h3><i class="fas fa-edit"></i> Revisi</h3>
                    <p>Minta perbaikan dengan catatan</p>
                </div>
            </div>

            <div id="revisionNotesSection" class="revision-notes-section">
                <form id="revisionForm">
                    <div class="form-group">
                        <label class="form-label" for="revisionNotes">Catatan Revisi (min. 10 karakter)</label>
                        <textarea id="revisionNotes" class="form-textarea" name="notes" rows="5" required></textarea>
                        <div class="char-counter">Karakter: <span id="charCount">0</span>/1000</div>
                    </div>
                    <button type="submit" class="submit-button">Kirim Revisi</button>
                </form>
            </div>
        `;

        reviewContent.innerHTML = content;
        setupRevisionForm();
    })
    .catch(error => {
        reviewContent.innerHTML = `
            <div style="text-align: center; padding: 40px; color: var(--red-600);">
                <i class="fas fa-exclamation-triangle" style="font-size: 2rem;"></i>
                <h4>Error Loading Submission</h4>
                <p>${error.message}</p>
            </div>
        `;
        showNotification('Gagal memuat submission', 'error');
    });
}

function showRevisionForm() {
    const section = document.getElementById('revisionNotesSection');
    section.classList.add('active');
    document.getElementById('revisionNotes').focus();
}

function setupRevisionForm() {
    const form = document.getElementById('revisionForm');
    const textarea = document.getElementById('revisionNotes');
    const charCount = document.getElementById('charCount');

    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            this.style.borderColor = (count < 10 || count > 1000) 
                ? 'var(--red-600)' 
                : 'var(--gray-200)';
        });
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const notes = textarea.value.trim();
            
            if (notes.length < 10) {
                showNotification('Catatan revisi minimal 10 karakter!', 'error');
                return;
            }
            if (notes.length > 1000) {
                showNotification('Catatan revisi maksimal 1000 karakter!', 'error');
                return;
            }
            
            updateStatus(currentSubmissionId, 'revisi', notes);
        });
    }
}

// ============================================
// UPDATE STATUS - CORE FUNCTION
// ============================================
function updateStatus(submissionId, status, notes = null) {
    console.log('🚀 updateStatus:', { submissionId, status, hasNotes: !!notes });
    
    if (!submissionId || isNaN(submissionId)) {
        console.error('❌ Invalid submissionId:', submissionId);
        showNotification('Error: Invalid submission ID', 'error');
        return;
    }
    
    const data = {
        status: status,
        _token: document.querySelector('meta[name="csrf-token"]').content
    };
    
    if (status === 'revisi' && notes) {
        data.notes = notes;
    }

    const loadingMsg = status === 'selesai' 
        ? 'Memproses penyelesaian project...' 
        : 'Mengirim permintaan revisi...';
    showNotification(loadingMsg, 'info');

    fetch(`/submit-projects/${submissionId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log('📥 Response:', response.status, response.statusText);
        
        return response.text().then(text => {
            console.log('📄 Raw response:', text.substring(0, 200));
            
            try {
                const json = JSON.parse(text);
                return { ok: response.ok, status: response.status, data: json };
            } catch (e) {
                console.error('❌ JSON parse error:', e);
                throw new Error(`Invalid JSON response (Status: ${response.status})`);
            }
        });
    })
    .then(result => {
        console.log('✅ Result:', result);
        
        if (result.ok && result.data.success) {
            showNotification(result.data.message, 'success');
            closeModal('reviewSubmissionModal');
            closeModal('editNotesModal');
            
            setTimeout(() => {
                console.log('🔄 Reloading page...');
                location.reload();
            }, 1500);
        } else {
            console.error('❌ Server error:', result.data);
            showNotification(result.data.message || 'Gagal mengupdate status', 'error');
        }
    })
    .catch(error => {
        console.error('💥 Error:', error);
        showNotification('Terjadi kesalahan: ' + error.message, 'error');
    });
}

// ============================================
// SELESAI BUTTON WITH RATING
// ============================================
function handleSelesaiClick(submissionId) {
    console.log('🟢 handleSelesaiClick:', submissionId);
    
    if (!submissionId || isNaN(submissionId)) {
        console.error('❌ Invalid submissionId');
        showNotification('Error: Invalid submission ID', 'error');
        return;
    }
    
    window.pendingSubmissionId = submissionId;
    console.log('✅ Stored pendingSubmissionId:', window.pendingSubmissionId);
    
    closeModal('reviewSubmissionModal');
    
    setTimeout(() => {
        openRatingModal(currentProjectId, 0);
        
        const originalSubmitRating = window.submitRating;
        
        window.submitRating = function() {
            console.log('⭐ submitRating called:', {
                selectedRating,
                pendingSubmissionId: window.pendingSubmissionId
            });
            
            if (selectedRating === 0) {
                showNotification('Silakan pilih rating terlebih dahulu!', 'error');
                return;
            }

            // Update rating display
            const projectRow = document.querySelector(`tr[data-project-id="${currentRatingProjectId}"]`);
            if (projectRow) {
                const ratingCell = projectRow.querySelector('.rating-display');
                if (ratingCell) {
                    const stars = ratingCell.querySelectorAll('.fa-star');
                    stars.forEach((star, index) => {
                        star.style.color = index < selectedRating 
                            ? 'var(--yellow-600)' 
                            : 'var(--gray-300)';
                    });
                    
                    const ratingSpan = ratingCell.querySelector('span');
                    if (ratingSpan) {
                        ratingSpan.textContent = `(${selectedRating}.0)`;
                    }
                }
            }

            // Create summary
            let summary = '';
            if (Object.keys(selectedAssessments).length > 0) {
                const text = [];
                if (selectedAssessments.timeliness) {
                    text.push(`Ketepatan Waktu: ${selectedAssessments.timeliness}`);
                }
                if (selectedAssessments.quality) {
                    text.push(`Kualitas: ${selectedAssessments.quality}`);
                }
                if (text.length > 0) {
                    summary = ` dengan penilaian ${text.join(', ')}`;
                }
            }

            closeModal('ratingModal');
            
            console.log('📤 Calling updateStatus with:', window.pendingSubmissionId);
            updateStatus(window.pendingSubmissionId, 'selesai');
            
            showNotification(`Project selesai dengan rating ${selectedRating} bintang${summary}!`, 'success');
            
            window.submitRating = originalSubmitRating;
            delete window.pendingSubmissionId;
        };
    }, 300);
}

// ============================================
// RATING MODAL
// ============================================
function openRatingModal(projectId, currentRating) {
    currentRatingProjectId = projectId;
    selectedRating = Math.floor(currentRating);
    selectedAssessments = {};
    
    document.getElementById('reviewText').value = '';
    updateStarDisplay(selectedRating);
    updateRatingText(selectedRating);
    resetAssessmentSelections();
    
    openModal('ratingModal');
}

function updateStarDisplay(rating) {
    const stars = document.querySelectorAll('#starRating .star');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
}

function updateRatingText(rating) {
    const texts = {
        0: 'Pilih rating',
        1: 'Sangat buruk',
        2: 'Buruk', 
        3: 'Cukup',
        4: 'Bagus',
        5: 'Sangat bagus'
    };
    document.getElementById('ratingText').textContent = texts[rating] || 'Pilih rating';
}

function resetAssessmentSelections() {
    selectedAssessments = {};
    document.querySelectorAll('.assessment-option').forEach(option => {
        option.classList.remove('selected');
    });
}

function submitRating() {
    if (selectedRating === 0) {
        showNotification('Silakan pilih rating terlebih dahulu!', 'error');
        return;
    }

    const reviewText = document.getElementById('reviewText').value.trim();
    
    const projectRow = document.querySelector(`tr[data-project-id="${currentRatingProjectId}"]`);
    if (projectRow) {
        const ratingCell = projectRow.querySelector('.rating-display');
        if (ratingCell) {
            const stars = ratingCell.querySelectorAll('.fa-star');
            stars.forEach((star, index) => {
                star.style.color = index < selectedRating 
                    ? 'var(--yellow-600)' 
                    : 'var(--gray-300)';
            });
            
            const ratingSpan = ratingCell.querySelector('span');
            if (ratingSpan) {
                ratingSpan.textContent = `(${selectedRating}.0)`;
            }
        }
    }

    let summary = '';
    if (Object.keys(selectedAssessments).length > 0) {
        const text = [];
        if (selectedAssessments.timeliness) {
            text.push(`Ketepatan Waktu: ${selectedAssessments.timeliness}`);
        }
        if (selectedAssessments.quality) {
            text.push(`Kualitas: ${selectedAssessments.quality}`);
        }
        if (text.length > 0) {
            summary = ` dengan penilaian ${text.join(', ')}`;
        }
    }

    showNotification(`Rating ${selectedRating} bintang berhasil diberikan${summary}!`, 'success');
    closeModal('ratingModal');
}

// Star rating handlers
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#starRating .star');
    stars.forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.dataset.rating);
            updateStarDisplay(selectedRating);
            updateRatingText(selectedRating);
        });

        star.addEventListener('mouseenter', function() {
            updateStarDisplay(parseInt(this.dataset.rating));
        });
    });

    document.getElementById('starRating').addEventListener('mouseleave', function() {
        updateStarDisplay(selectedRating);
    });

    // Assessment handlers
    document.querySelectorAll('.assessment-option').forEach(option => {
        option.addEventListener('click', function() {
            const group = this.closest('.assessment-options');
            const type = group.dataset.assessment;
            const value = this.dataset.value;
            
            group.querySelectorAll('.assessment-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            this.classList.add('selected');
            selectedAssessments[type] = value;
        });
    });
});

// ============================================
// EDIT NOTES
// ============================================
function editNotes(submissionId) {
    currentSubmissionId = submissionId;
    
    fetch(`/submit-projects/${submissionId}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('editSubmissionId').value = submissionId;
        document.getElementById('editRevisionNotes').value = data.notes || '';
        document.getElementById('editCharCount').textContent = (data.notes || '').length;
        openModal('editNotesModal');
    })
    .catch(error => {
        showNotification('Gagal memuat notes', 'error');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editNotesForm');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const notes = document.getElementById('editRevisionNotes').value.trim();
            
            if (notes.length < 10) {
                showNotification('Catatan minimal 10 karakter!', 'error');
                return;
            }
            if (notes.length > 1000) {
                showNotification('Catatan maksimal 1000 karakter!', 'error');
                return;
            }
            
            updateStatus(currentSubmissionId, 'revisi', notes);
        });
    }

    const editTextarea = document.getElementById('editRevisionNotes');
    if (editTextarea) {
        editTextarea.addEventListener('input', function() {
            const count = this.value.length;
            document.getElementById('editCharCount').textContent = count;
            this.style.borderColor = (count < 10 || count > 1000) 
                ? 'var(--red-600)' 
                : 'var(--gray-200)';
        });
    }
});

// ============================================
// TUTORIAL MODAL
// ============================================
function openTutorialModal() {
    openModal('tutorialModal');
}

// ============================================
// DELETE PROJECT
// ============================================
function confirmDeleteProject(projectId, projectTitle) {
    if (confirm(`Apakah Anda yakin ingin menghapus project "${projectTitle}"?`)) {
        deleteProject(projectId);
    }
}

function deleteProject(projectId) {
    fetch(`/projects/${projectId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message || 'Project berhasil dihapus!', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showNotification(data.message || 'Gagal menghapus project', 'error');
        }
    })
    .catch(error => {
        showNotification('Error: ' + error.message, 'error');
    });
}

// ============================================
// CANCEL PROJECT FUNCTIONS
// ============================================
window.openCancelModal = function(projectId, projectTitle, hasFreelancer = false) {
    console.log('🔴 openCancelModal:', { projectId, projectTitle, hasFreelancer });
    
    if (hasFreelancer) {
        openCancelWorkingModal(projectId, projectTitle);
    } else {
        openCancelOpenModal(projectId, projectTitle);
    }
};

function openCancelOpenModal(projectId, projectTitle) {
    currentCancelProject = { id: projectId, title: projectTitle };
    
    document.getElementById('cancelOpenProjectId').value = projectId;
    document.getElementById('cancelOpenReason').value = '';
    document.getElementById('cancelOpenReasonCount').textContent = '0';
    document.getElementById('cancelOpenBankName').value = '';
    document.getElementById('cancelOpenAccountNumber').value = '';
    document.getElementById('cancelOpenEvidence').value = '';
    document.getElementById('cancelOpenFileList').innerHTML = '';
    
    cancelEvidenceFiles = [];
    
    openModal('cancelOpenModal');
}

function openCancelWorkingModal(projectId, projectTitle) {
    console.log('🟡 openCancelWorkingModal:', projectId);
    
    document.getElementById('cancelWorkingProjectId').value = projectId;
    document.getElementById('cancelWorkingReason').value = '';
    document.getElementById('cancelWorkingCharCount').textContent = '0';
    document.getElementById('bankSelectWorking').value = '';
    document.getElementById('accountNumberWorking').value = '';
    document.getElementById('cancelEvidenceFilesWorking').value = '';
    document.getElementById('cancelFileListWorking').innerHTML = '';
    
    cancelEvidenceFiles = [];
    
    // Extract project info from table
    const projectRow = Array.from(document.querySelectorAll('tr')).find(row => {
        const buttons = row.querySelectorAll('button');
        return Array.from(buttons).some(btn => 
            btn.getAttribute('onclick')?.includes(`openCancelModal(${projectId}`)
        );
    });
    
    if (projectRow) {
        const cells = projectRow.querySelectorAll('td');
        
        let freelancerName = '-';
        for (let cell of cells) {
            if (cell.textContent.length > 3 && 
                !cell.textContent.includes('Rp') && 
                !cell.textContent.includes('%')) {
                freelancerName = cell.textContent.trim();
                break;
            }
        }
        
        let progress = '0%';
        const progressBar = projectRow.querySelector('.progress-bar');
        if (progressBar) {
            progress = progressBar.style.width || '0%';
        }
        
        let status = '-';
        const statusBadge = projectRow.querySelector('.status-badge');
        if (statusBadge) {
            status = statusBadge.textContent.trim();
        }
        
        let deadline = '-';
        const deadlineBadge = projectRow.querySelector('.deadline-badge');
        if (deadlineBadge) {
            deadline = deadlineBadge.textContent.trim();
        }
        
        document.getElementById('cancelWorkingFreelancer').textContent = freelancerName;
        document.getElementById('cancelWorkingProgress').textContent = progress;
        document.getElementById('cancelWorkingStatus').textContent = status;
        document.getElementById('cancelWorkingDeadline').textContent = deadline;
    }
    
    openModal('cancelWorkingModal');
}

// ============================================
// SUBMIT CANCEL OPEN PROJECT
// ============================================
window.submitOpenCancel = function() {
    const reason = document.getElementById('cancelOpenReason')?.value.trim();
    const bankName = document.getElementById('cancelOpenBankName')?.value;
    const accountNumber = document.getElementById('cancelOpenAccountNumber')?.value.trim();
    const projectId = document.getElementById('cancelOpenProjectId')?.value;
    
    const repostCheckbox = document.getElementById('repostProject');
    const shouldRepost = (repostCheckbox && repostCheckbox.checked);
    
    // Validation
    if (!reason || reason.length < 10) {
        showNotification('Alasan minimal 10 karakter!', 'error');
        return false;
    }
    
    if (reason.length > 500) {
        showNotification('Alasan maksimal 500 karakter!', 'error');
        return false;
    }
    
    if (!bankName) {
        showNotification('Bank harus dipilih!', 'error');
        return false;
    }
    
    if (!accountNumber || !/^\d+$/.test(accountNumber)) {
        showNotification('Nomor rekening harus diisi (hanya angka)!', 'error');
        return false;
    }
    
    const formData = new FormData();
    formData.append('reason', reason);
    formData.append('bank_name', bankName);
    formData.append('account_number', accountNumber);
    formData.append('repost_project', shouldRepost ? '1' : '0');
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) {
        showNotification('CSRF token tidak ditemukan!', 'error');
        return false;
    }
    formData.append('_token', csrfToken);
    
    cancelEvidenceFiles.forEach((file, index) => {
        formData.append(`evidence_files[${index}]`, file);
    });
    
    showNotification('Memproses pengajuan pembatalan...', 'info');
    
    fetch(`/projects/${projectId}/cancel-open`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        return response.json();
    })
    .then(data => {
        if (data.success) {
            let successMsg = data.message;
            if (shouldRepost) {
                successMsg += '<br><small style="color: #059669;">Proyek akan otomatis di-posting ulang setelah disetujui</small>';
            }
            
            showNotification(successMsg, 'success');
            closeModal('cancelOpenModal');
            
            setTimeout(() => {
                if (shouldRepost) {
                    window.location.href = `/projects/${projectId}/edit`;
                } else {
                    location.reload();
                }
            }, 1500);
        } else {
            showNotification(data.message || 'Gagal membatalkan project', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan: ' + error.message, 'error');
    });
    
    return false;
};

// ============================================
// SUBMIT CANCEL WORKING PROJECT
// ============================================
window.submitWorkingCancel = function() {
    const reason = document.getElementById('cancelWorkingReason')?.value.trim();
    const bankName = document.getElementById('bankSelectWorking')?.value;
    const accountNumber = document.getElementById('accountNumberWorking')?.value.trim();
    const projectId = document.getElementById('cancelWorkingProjectId')?.value;
    
    const repostCheckbox = document.getElementById('repostProjectWorking');
    const shouldRepost = (repostCheckbox && repostCheckbox.checked);
    
    // Validation
    if (!reason || reason.length < 10) {
        showNotification('Alasan minimal 10 karakter!', 'error');
        return false;
    }

    if (!bankName) {
        showNotification('Bank harus dipilih!', 'error');
        return false;
    }

    if (!accountNumber || !/^\d+$/.test(accountNumber)) {
        showNotification('Nomor rekening harus diisi (hanya angka)!', 'error');
        return false;
    }
    
    const formData = new FormData();
    formData.append('reason', reason);
    formData.append('bank_name', bankName);
    formData.append('account_number', accountNumber);
    formData.append('repost_project', shouldRepost ? '1' : '0');
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) {
        showNotification('CSRF token tidak ditemukan!', 'error');
        return false;
    }
    formData.append('_token', csrfToken);
    
    const fileInput = document.getElementById('cancelEvidenceFilesWorking');
    if (fileInput && fileInput.files) {
        Array.from(fileInput.files).forEach(file => {
            formData.append('evidence_files[]', file);
        });
    }
    
    showNotification('Memproses pembatalan project...', 'info');
    
    fetch(`/projects/${projectId}/cancel-working`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        return response.text().then(text => {
            try {
                const json = JSON.parse(text);
                return { ok: response.ok, status: response.status, data: json };
            } catch (e) {
                throw new Error(`Invalid JSON response (Status: ${response.status})`);
            }
        });
    })
    .then(result => {
        if (result.ok && result.data.success) {
            let successMsg = result.data.message;
            if (shouldRepost) {
                successMsg += '<br><small style="color: #059669;">Proyek akan otomatis di-posting ulang setelah disetujui</small>';
            }
            
            showNotification(successMsg, 'success');
            closeModal('cancelWorkingModal');
            
            setTimeout(() => {
                if (shouldRepost) {
                    window.location.href = `/projects/${projectId}/edit`;
                } else {
                    location.reload();
                }
            }, 1500);
        } else {
            showNotification(result.data.message || 'Gagal membatalkan project', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan: ' + error.message, 'error');
    });
    
    return false;
};

// ============================================
// FILE UPLOAD HANDLERS
// ============================================
function handleFileUpload() {
    const fileInput = document.getElementById('cancelEvidenceFiles');
    if (!fileInput) return;
    
    fileInput.addEventListener('change', function(e) {
        Array.from(e.target.files).forEach(file => {
            if (file.size > 5 * 1024 * 1024) {
                showNotification(`${file.name} terlalu besar! Max 5MB`, 'error');
                return;
            }
            
            const allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                           'application/pdf', 'application/msword',
                           'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                           'text/plain'];
            
            if (!allowed.includes(file.type)) {
                showNotification(`Format ${file.name} tidak didukung!`, 'error');
                return;
            }
            
            cancelEvidenceFiles.push(file);
        });
        
        updateFileList();
        fileInput.value = '';
    });
}

function updateFileList() {
    const fileList = document.getElementById('cancelOpenFileList');
    if (!fileList) return;
    
    fileList.innerHTML = cancelEvidenceFiles.map((file, index) => {
        const size = (file.size / 1024).toFixed(1) + ' KB';
        const ext = file.name.split('.').pop().toLowerCase();
        
        let icon = 'fas fa-file';
        let color = '#6b7280';
        
        if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
            icon = 'fas fa-image';
            color = '#059669';
        } else if (ext === 'pdf') {
            icon = 'fas fa-file-pdf';
            color = '#dc2626';
        }
        
        return `
            <div class="file-item">
                <div class="file-info">
                    <i class="${icon}" style="color: ${color};"></i>
                    <span class="file-name">${file.name}</span>
                    <span class="file-size">(${size})</span>
                </div>
                <button type="button" class="file-remove" onclick="removeFile(${index})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
    }).join('');
}

window.removeFile = function(index) {
    cancelEvidenceFiles.splice(index, 1);
    updateFileList();
};

// ============================================
// CHARACTER COUNTERS
// ============================================
function setupCharCounters() {
    // Cancel Open Reason
    const cancelOpenTextarea = document.getElementById('cancelOpenReason');
    const cancelOpenCounter = document.getElementById('cancelOpenReasonCount');
    
    if (cancelOpenTextarea && cancelOpenCounter) {
        cancelOpenTextarea.addEventListener('input', function() {
            const count = this.value.length;
            cancelOpenCounter.textContent = count;
            
            if (count < 10 || count > 500) {
                this.style.borderColor = '#dc2626';
                cancelOpenCounter.style.color = '#dc2626';
            } else {
                this.style.borderColor = '#059669';
                cancelOpenCounter.style.color = '#059669';
            }
        });
    }
    
    // Cancel Working Reason
    const cancelWorkingTextarea = document.getElementById('cancelWorkingReason');
    const cancelWorkingCounter = document.getElementById('cancelWorkingCharCount');
    
    if (cancelWorkingTextarea && cancelWorkingCounter) {
        cancelWorkingTextarea.addEventListener('input', function() {
            const count = this.value.length;
            cancelWorkingCounter.textContent = count;
            
            if (count < 10 || count > 500) {
                this.style.borderColor = '#dc2626';
                cancelWorkingCounter.style.color = '#dc2626';
            } else {
                this.style.borderColor = '#059669';
                cancelWorkingCounter.style.color = '#059669';
            }
        });
    }
}

// ============================================
// INITIALIZE ALL EVENT LISTENERS
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Jobboard JavaScript initialized');
    
    handleFileUpload();
    setupCharCounters();
    
    // File input for working cancel
    const workingFileInput = document.getElementById('cancelEvidenceFilesWorking');
    if (workingFileInput) {
        workingFileInput.addEventListener('change', function(e) {
            Array.from(e.target.files).forEach(file => {
                if (file.size > 5 * 1024 * 1024) {
                    showNotification(`${file.name} terlalu besar! Max 5MB`, 'error');
                    return;
                }
                cancelEvidenceFiles.push(file);
            });
        });
    }
});

// ============================================
// CONSOLE LOG FOR DEBUGGING
// ============================================
console.log('✅ Jobboard Client JavaScript Loaded Successfully');

    </script>
    <script>
        // ============================================
// FIXED VERSION - Remove console.logs and alerts
// ============================================

let currentCancelProject = null;
let cancelEvidenceFiles = [];


// ============================================
// FUNCTION: Submit Cancellation - FIXED
// ============================================
window.submitOpenCancel = function() {
    // Get values
    const reason = document.getElementById('cancelOpenReason')?.value.trim();
    const bankName = document.getElementById('bankSelect')?.value;
    const accountNumber = document.getElementById('accountNumber')?.value.trim();
    const projectId = document.getElementById('cancelProjectId')?.value;
    
    // Validation
    if (!reason) {
        showNotification('Alasan harus diisi!', 'error');
        return false;
    }
    
    if (reason.length < 10) {
        showNotification('Alasan minimal 10 karakter!', 'error');
        return false;
    }
    
    if (reason.length > 500) {
        showNotification('Alasan maksimal 500 karakter!', 'error');
        return false;
    }
    
    if (!bankName) {
        showNotification('Bank harus dipilih!', 'error');
        return false;
    }
    
    if (!accountNumber) {
        showNotification('Nomor rekening harus diisi!', 'error');
        return false;
    }
    
    if (!/^\d+$/.test(accountNumber)) {
        showNotification('Nomor rekening hanya boleh angka!', 'error');
        return false;
    }
    
    // Prepare FormData
    const formData = new FormData();
    formData.append('reason', reason);
    formData.append('bank_name', bankName);
    formData.append('account_number', accountNumber);
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) {
        showNotification('CSRF token tidak ditemukan!', 'error');
        return false;
    }
    formData.append('_token', csrfToken);
    
    // Add files
    cancelEvidenceFiles.forEach((file, index) => {
        formData.append(`evidence_files[${index}]`, file);
    });
    
    // Update button to loading state
    const submitBtn = document.getElementById('submitCancelBtn');
    const originalHTML = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    
    // Send request
    const url = `/projects/${projectId}/cancel-open`;
    
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        // Check if response is ok
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalHTML;
        
        if (data.success) {
            showNotification(data.message || 'Project berhasil dibatalkan!', 'success');
            closeModal('cancelOpenModal');
            
            // Reload after 1.5 seconds
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showNotification(data.message || 'Gagal membatalkan project', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalHTML;
        
        showNotification('Terjadi kesalahan: ' + error.message, 'error');
    });
    
    return false;
};

// ============================================
// File Upload Handler
// ============================================
function handleFileUpload() {
    const fileInput = document.getElementById('cancelEvidenceFiles');
    if (!fileInput) return;
    
    fileInput.addEventListener('change', function(e) {
        Array.from(e.target.files).forEach(file => {
            // Validate size
            if (file.size > 5 * 1024 * 1024) {
                showNotification(`${file.name} terlalu besar! Max 5MB`, 'error');
                return;
            }
            
            // Validate type
            const allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                           'application/pdf', 'application/msword',
                           'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                           'text/plain'];
            
            if (!allowed.includes(file.type)) {
                showNotification(`Format ${file.name} tidak didukung!`, 'error');
                return;
            }
            
            cancelEvidenceFiles.push(file);
        });
        
        updateFileList();
        fileInput.value = '';
    });
}

// ✅ File input handler untuk cancel working
const cancelFileInput = document.getElementById('cancelEvidenceFilesWorking');
const cancelFileList = document.getElementById('cancelFileListWorking');

if (cancelFileInput && cancelFileList) {
    cancelFileInput.addEventListener('change', function() {
        updateFileList(this.files, cancelFileList);
    });
}

// ✅ Function untuk update file list preview
function updateFileList(files, container) {
    container.innerHTML = '';
    
    if (files.length === 0) return;
    
    Array.from(files).forEach((file, index) => {
        const fileItem = document.createElement('div');
        fileItem.className = 'file-item';
        
        let displayName = file.name;
        if (displayName.length > 35) {
            const ext = displayName.split('.').pop();
            displayName = displayName.substring(0, 35 - ext.length - 4) + '...' + ext;
        }
        
        fileItem.innerHTML = `
            <span class="file-name">
                <i class="fas fa-file" style="margin-right: 6px; color: #6b7280;"></i>
                ${displayName} (${formatFileSize(file.size)})
            </span>
            <button type="button" class="file-remove" onclick="removeFileFromList(${index}, 'cancelEvidenceFilesWorking')">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        container.appendChild(fileItem);
    });
}

window.removeFile = function(index) {
    cancelEvidenceFiles.splice(index, 1);
    updateFileList();
};

// ✅ Function untuk remove file dari list
function removeFileFromList(index, inputId) {
    const input = document.getElementById(inputId);
    const dt = new DataTransfer();
    const files = input.files;
    
    for (let i = 0; i < files.length; i++) {
        if (i !== index) {
            dt.items.add(files[i]);
        }
    }
    
    input.files = dt.files;
    
    const container = inputId === 'cancelEvidenceFilesWorking' 
        ? document.getElementById('cancelFileListWorking')
        : document.getElementById('cancelFileList');
    
    updateFileList(input.files, container);
}

// ============================================
// Character Counter
// ============================================
function setupCharCounter() {
    const textarea = document.getElementById('cancelOpenReason');
    const counter = document.getElementById('cancelOpenCharCount');
    
    if (!textarea || !counter) return;
    
    textarea.addEventListener('input', function() {
        const count = this.value.length;
        counter.textContent = count;
        
        if (count < 10 || count > 500) {
            this.style.borderColor = '#dc2626';
            counter.style.color = '#dc2626';
        } else {
            this.style.borderColor = '#059669';
            counter.style.color = '#059669';
        }
    });
}

function openCancelWorkingModal(projectId, projectTitle) {
    console.log('🟡 Opening cancel WORKING modal for project:', projectId);
    
    // Reset form working
    document.getElementById('cancelWorkingProjectId').value = projectId;
    document.getElementById('cancelWorkingReason').value = '';
    document.getElementById('cancelWorkingCharCount').textContent = '0';
    document.getElementById('bankSelectWorking').value = '';
    document.getElementById('accountNumberWorking').value = '';
    document.getElementById('cancelEvidenceFilesWorking').value = '';
    document.getElementById('cancelFileListWorking').innerHTML = '';
    
    // Reset files untuk working modal
    cancelEvidenceFiles = [];
    
    // Cari data project dari tabel
    const projectRow = Array.from(document.querySelectorAll('tr')).find(row => {
        const buttons = row.querySelectorAll('button');
        return Array.from(buttons).some(btn => 
            btn.getAttribute('onclick')?.includes(`openCancelModal(${projectId}`) ||
            btn.getAttribute('onclick')?.includes(`openCancelWorkingModal(${projectId}`)
        );
    });
    
    if (projectRow) {
        try {
            const cells = projectRow.querySelectorAll('td');
            
            // Cari freelancer name
            let freelancerName = '-';
            for (let cell of cells) {
                if (cell.textContent.includes('@') || 
                    (cell.textContent.length > 3 && !cell.textContent.includes('Rp') && 
                     !cell.textContent.includes('%') && !cell.textContent.match(/\d{2}\/\d{2}\/\d{4}/))) {
                    freelancerName = cell.textContent.trim();
                    break;
                }
            }
            
            // Cari progress
            let progress = '0%';
            const progressBar = projectRow.querySelector('.progress-bar');
            if (progressBar) {
                progress = progressBar.style.width || '0%';
            }
            
            // Cari status
            let status = '-';
            const statusBadge = projectRow.querySelector('.status-badge');
            if (statusBadge) {
                status = statusBadge.textContent.trim();
            }
            
            // Cari deadline
            let deadline = '-';
            const deadlineBadge = projectRow.querySelector('.deadline-badge');
            if (deadlineBadge) {
                deadline = deadlineBadge.textContent.trim();
            }
            
            document.getElementById('cancelWorkingFreelancer').textContent = freelancerName;
            document.getElementById('cancelWorkingProgress').textContent = progress;
            document.getElementById('cancelWorkingStatus').textContent = status;
            document.getElementById('cancelWorkingDeadline').textContent = deadline;
            
        } catch (error) {
            console.error('Error extracting project data:', error);
        }
    }
    
    openModal('cancelWorkingModal');
}

// Tambahkan di bagian setup event listeners
function setupWorkingModalEventListeners() {
    const cancelWorkingTextarea = document.getElementById('cancelWorkingReason');
    const cancelWorkingCharCounter = document.getElementById('cancelWorkingCharCount');

    if (cancelWorkingTextarea && cancelWorkingCharCounter) {
        cancelWorkingTextarea.addEventListener('input', function() {
            const count = this.value.length;
            cancelWorkingCharCounter.textContent = count;
            
            if (count < 10 || count > 500) {
                this.style.borderColor = '#dc2626';
                cancelWorkingCharCounter.style.color = '#dc2626';
            } else {
                this.style.borderColor = '#059669';
                cancelWorkingCharCounter.style.color = '#059669';
            }
        });
    }
    
    // Setup file upload untuk working modal
    const fileInputWorking = document.getElementById('cancelEvidenceFilesWorking');
    if (fileInputWorking) {
        fileInputWorking.addEventListener('change', function(e) {
            Array.from(e.target.files).forEach(file => {
                if (file.size > 5 * 1024 * 1024) {
                    showNotification(`${file.name} terlalu besar! Max 5MB`, 'error');
                    return;
                }
                
                const allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                               'application/pdf', 'application/msword',
                               'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                               'text/plain'];
                
                if (!allowed.includes(file.type)) {
                    showNotification(`Format ${file.name} tidak didukung!`, 'error');
                    return;
                }
                
                cancelEvidenceFiles.push(file);
            });
            
            updateFileListWorking();
            fileInputWorking.value = '';
        });
    }
}

function updateFileListWorking() {
    const fileList = document.getElementById('cancelFileListWorking');
    if (!fileList) return;
    
    fileList.innerHTML = cancelEvidenceFiles.map((file, index) => {
        const size = (file.size / 1024).toFixed(1) + ' KB';
        const ext = file.name.split('.').pop().toLowerCase();
        
        let icon = 'fas fa-file';
        let color = '#6b7280';
        
        if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
            icon = 'fas fa-image';
            color = '#059669';
        } else if (ext === 'pdf') {
            icon = 'fas fa-file-pdf';
            color = '#dc2626';
        } else if (['doc', 'docx'].includes(ext)) {
            icon = 'fas fa-file-word';
            color = '#1d4ed8';
        }
        
        return `
            <div class="file-item">
                <div class="file-info">
                    <i class="${icon} file-icon" style="color: ${color};"></i>
                    <span class="file-name" title="${file.name}">${file.name}</span>
                    <span class="file-size">(${size})</span>
                </div>
                <button type="button" class="file-remove" onclick="removeFile(${index})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
    }).join('');
}

// Function untuk konfirmasi hapus project tanpa freelancer
function confirmDeleteProject(projectId, projectTitle) {
    if (confirm(`Apakah Anda yakin ingin menghapus project "${projectTitle}"? \n\nProject yang belum memiliki freelancer akan dihapus permanen.`)) {
        deleteProject(projectId);
    }
}

// Function untuk hapus project permanen (tanpa freelancer)
function deleteProject(projectId) {
    const submitBtn = document.querySelector(`[onclick="confirmDeleteProject(${projectId}"]`);
    const originalHTML = submitBtn?.innerHTML;
    
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    }

    fetch(`/projects/${projectId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message || 'Project berhasil dihapus permanen!', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showNotification(data.message || 'Gagal menghapus project', 'error');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error: ' + error.message, 'error');
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;
        }
    });
}


function goToWorkingTab(projectId) {
    document.querySelector('[data-tab="working"]').click();

    // Scroll ke row yang sesuai
    setTimeout(() => {
        const row = document.querySelector(`#working tr[data-project-id="${projectId}"]`);
        if (row) {
            row.style.background = "#fef9c3";
            row.scrollIntoView({ behavior: "smooth", block: "center" });

            // Hilangkan highlight setelah 2 detik
            setTimeout(() => row.style.background = "", 2000);
        }
    }, 300);
}
// ============================================
// Initialize on DOM Ready
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    handleFileUpload();
    setupCharCounter();
    setupWorkingModalEventListeners();
});

async function submitCancelOpen() {
    const form = document.getElementById('cancelOpenForm');
    const formData = new FormData(form);
    const projectId = document.getElementById('cancelOpenProjectId').value;
    
    // ✅ PERBAIKAN: Ambil nilai checkbox dengan benar
    const repostCheckbox = document.getElementById('repostProject');
    const repostValue = (repostCheckbox && repostCheckbox.checked) ? '1' : '0';
    
    // ✅ PENTING: Set nilai ke FormData (akan override value dari form)
    formData.set('repost_project', repostValue);
    
    console.log('📋 Checkbox Status:', {
        checked: repostCheckbox?.checked,
        value: repostValue,
        formDataValue: formData.get('repost_project')
    });

    // Validasi
    const reason = formData.get('reason');
    const bankName = formData.get('bank_name');
    const accountNumber = formData.get('account_number');

    if (!reason || reason.length < 10) {
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            text: 'Alasan pembatalan minimal 10 karakter!',
            confirmButtonColor: '#dc2626'
        });
        return;
    }

    if (!bankName) {
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            text: 'Silakan pilih bank!',
            confirmButtonColor: '#dc2626'
        });
        return;
    }

    if (!accountNumber || !/^[0-9]+$/.test(accountNumber)) {
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            text: 'Nomor rekening harus berupa angka!',
            confirmButtonColor: '#dc2626'
        });
        return;
    }

    try {
        // ✅ LOG untuk debugging
        console.log('🚀 Mengirim data:', {
            projectId,
            reason: reason.substring(0, 50) + '...',
            bankName,
            accountNumber: accountNumber.substring(0, 4) + '****',
            repost_project: repostValue
        });

        const response = await fetch(`/projects/${projectId}/cancel-open`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            closeModal('cancelOpenModal');
            
            // ✅ Pesan berbeda jika checkbox dicentang
            let successMessage = result.message;
            if (repostValue === '1') {
                successMessage += '<br><br><small style="color: #059669;"><i class="fas fa-check-circle"></i> Proyek akan otomatis di-posting ulang setelah disetujui</small>';
            }
            
            Swal.fire({
                icon: 'success',
                title: 'Pengajuan Berhasil!',
                html: successMessage,
                confirmButtonColor: '#10b981'
            }).then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: result.message || 'Terjadi kesalahan',
                confirmButtonColor: '#dc2626'
            });
        }
    } catch (error) {
        console.error('❌ Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan koneksi',
            confirmButtonColor: '#dc2626'
        });
    }
}

// Character counter untuk reason
document.addEventListener('DOMContentLoaded', function() {
    const reasonTextarea = document.getElementById('cancelOpenReason');
    const reasonCount = document.getElementById('cancelOpenReasonCount');
    
    if (reasonTextarea && reasonCount) {
        reasonTextarea.addEventListener('input', function() {
            reasonCount.textContent = this.value.length;
        });
    }
});

    </script>
</body>
</html>
@endsection