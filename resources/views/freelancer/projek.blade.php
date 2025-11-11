@extends('client.layout.client-layout')
@section('title', 'Jobboard Freelancer - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Jobboard Freelancer</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    /* Your existing CSS remains the same */
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

    * {
      box-sizing: border-box
    }

    body {
      margin: 0;
      background: var(--bg);
      font-family: 'Inter', sans-serif;
      color: var(--gray-900);
    }

    button {
      cursor: pointer;
      background: none;
      border: none
    }

    main {
      padding: 1rem 1.5rem;
      max-width: 100%;
      margin: 0 auto
    }

    h1 {
      color: var(--blue-700);
      font-weight: 600;
      font-size: 1.25rem;
    }

    .subtitle {
      color: var(--gray-700);
      font-size: .75rem;
      margin-bottom: 1.5rem
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

    .table-wrap {
      overflow-x: auto
    }

    table {
      width: 97%;
      border-collapse: collapse;
      font-size: .75rem;
      margin: 15px;
      color: var(--gray-700);
    }

    th,
    td {
      border: 1px solid var(--gray-200);
      padding: .5rem;
      text-align: left
    }

    thead {
      background: var(--gray-50);
      color: var(--gray-600);
    }

    tbody tr:hover {
      background: var(--gray-50)
    }

    /* Table column widths - Updated for new layout */
    .applied-table thead th:nth-child(1) { width: 5%; }
    .applied-table thead th:nth-child(2) { width: 25%; }
    .applied-table thead th:nth-child(3) { width: 10%; }
    .applied-table thead th:nth-child(4) { width: 10%; }
    .applied-table thead th:nth-child(5) { width: 10%; }
    .applied-table thead th:nth-child(6) { width: 8%; }
    .applied-table thead th:nth-child(7) { width: 8%; }
    .applied-table thead th:nth-child(8) { width: 24%; }

    .working-table thead th:nth-child(1) { width: 5%; }
    .working-table thead th:nth-child(2) { width: 18%; }
    .working-table thead th:nth-child(3) { width: 10%; }
    .working-table thead th:nth-child(4) { width: 10%; }
    .working-table thead th:nth-child(5) { width: 11%; }
    .working-table thead th:nth-child(6) { width: 11%; }
    .working-table thead th:nth-child(7) { width: 8%; }
    .working-table thead th:nth-child(8) { width: 21%; }

    .review-table thead th:nth-child(1) { width: 5%; }
    .review-table thead th:nth-child(2) { width: 25%; }
    .review-table thead th:nth-child(3) { width: 15%; }
    .review-table thead th:nth-child(4) { width: 15%; }
    .review-table thead th:nth-child(5) { width: 15%; }
    .review-table thead th:nth-child(6) { width: 25%; }

    .completed-table thead th:nth-child(1) { width: 4%; }
    .completed-table thead th:nth-child(2) { width: 18%; }
    .completed-table thead th:nth-child(3) { width: 10%; }
    .completed-table thead th:nth-child(4) { width: 10%; }
    .completed-table thead th:nth-child(5) { width: 10%; }
    .completed-table thead th:nth-child(6) { width: 12%; }
    .completed-table thead th:nth-child(7) { width: 12%; }
    .completed-table thead th:nth-child(8) { width: 12%; }
    .completed-table thead th:nth-child(9) { width: 12%; }

    td a {
      color: var(--blue-700);
      text-decoration: none;
      font-weight: 600
    }

    td a:hover {
      text-decoration: underline
    }

    .hidden {
      display: none
    }

    /* Action buttons styling */
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
      border: none;
      cursor: pointer;
    }

    .btn-apply { background: var(--green-600); color: white; }
    .btn-apply:hover { background: var(--green-700); color: white; }
    .btn-view { background: var(--blue-700); color: white; }
    .btn-view:hover { background: var(--blue-800); color: white; }
    .btn-chat { background: var(--blue-700); color: white; }
    .btn-chat:hover { background: var(--blue-800); color: white; }
    .btn-upload { background: var(--green-600); color: white; }
    .btn-upload:hover { background: var(--green-700); color: white; }
    .btn-submit { background: var(--purple-600); color: white; }
    .btn-submit:hover { background: var(--purple-700); color: white; }
    .btn-submit:disabled { background: var(--gray-500); cursor: not-allowed; }
    .btn-edit { background: var(--yellow-600); color: white; }
    .btn-edit:hover { background: var(--yellow-700); color: white; }
    .btn-detail { background: var(--purple-600); color: white; }
    .btn-detail:hover { background: var(--purple-700); color: white; }
    .btn-drive { background: var(--green-600); color: white; padding: 0.2rem 0.4rem; font-size: 0.65rem; }
    .btn-drive:hover { background: var(--green-700); color: white; }
    .btn-monitor { background: var(--green-600); color: white; }
    .btn-monitor:hover { background: var(--green-700); color: white; }
    .btn-results { background: var(--orange-600); color: white; }
    .btn-results:hover { background: var(--orange-700); color: white; }

    /* Status badges */
    .status-badge {
      padding: 0.25rem 0.5rem;
      border-radius: 12px;
      font-size: 0.7rem;
      font-weight: 500;
      display: inline-block;
    }

    .status-pending { background: #fef3c7; color: var(--yellow-700); }
    .status-accepted { background: #d1fae5; color: var(--green-700); }
    .status-rejected { background: #fee2e2; color: var(--red-700); }
    .status-working { background: #dbeafe; color: var(--blue-700); }
    .status-review { background: #e0e7ff; color: var(--purple-700); }
    .status-revision { background: #fee2e2; color: var(--red-700); }
    .status-completed { background: #d1fae5; color: var(--green-700); }

    /* Progress bar */
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
/* UPDATE CSS MODAL - Tambahkan setelah existing modal styles */

/* Modal Base - Ganti yang sudah ada */
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

/* Modal Content Container - Update yang sudah ada */
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

/* Form Styles dalam Modal */
.form-group { 
    margin-bottom: 1.25rem; 
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: 0.875rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    background: white;
}

.form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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

.timeline-select {
  font-size: 0.7rem;
  padding: 0.15rem 1.8rem 0.15rem 0.5rem; /* kasih space kanan buat panah */
  border: 1px solid var(--blue-200);
  border-radius: 5px;
  background: #47918aff; /* biru muda */
  color: white; /* biar kontras sama biru */
  min-width: 120px;
  max-width: 150px;
  margin-right: 0.4rem;
  height: 26px;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  cursor: pointer;
  transition: all 0.2s ease;
  
  /* tambahkan panah custom */
  background-image: url("data:image/svg+xml;utf8,<svg fill='white' height='12' viewBox='0 0 20 20' width='12' xmlns='http://www.w3.org/2000/svg'><path d='M5.516 7.548L10 12.032l4.484-4.484L16 9.064 10 15.064 4 9.064z'/></svg>");
  background-repeat: no-repeat;
  background-position: right 0.5rem center;
  background-size: 12px;
}

.timeline-select:focus {
  outline: none;
  border-color: var(--blue-400);
  box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
}

.timeline-select:hover {
  background-color: #3c7e77ff;
}



    .job-detail {
      margin-bottom: 15px;
    }

    .job-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--blue-700);
      margin-bottom: 8px;
    }

    .job-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-bottom: 15px;
      padding: 15px;
      background: var(--gray-50);
      border-radius: 6px;
    }

    .job-description {
      margin: 15px 0;
      line-height: 1.6;
    }

    .requirements {
      background: #f0f9ff;
      border-left: 4px solid var(--blue-700);
      padding: 15px;
      margin: 15px 0;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: var(--gray-700);
    }

    .form-input {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid var(--gray-200);
      border-radius: 4px;
      font-size: 0.875rem;
    }

    .form-textarea {
      resize: vertical;
      min-height: 100px;
    }

    .submit-button {
      background: var(--green-600);
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
    }

    .submit-button:hover {
      background: var(--green-700);
    }

    .submit-button.purple {
      background: var(--purple-600);
    }

    .submit-button.purple:hover {
      background: var(--purple-700);
    }

    .progress-week {
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      border-radius: 6px;
      padding: 15px;
      margin-bottom: 15px;
    }

    .week-header {
      font-weight: 600;
      color: var(--blue-700);
      margin-bottom: 10px;
    }

    /* Google Drive Integration Styles */
    .drive-link-input {
      background: #f0f9ff;
      border: 2px solid var(--blue-700);
    }

    .drive-tutorial {
      background: #f0f9ff;
      border: 1px solid var(--blue-700);
      border-radius: 6px;
      padding: 15px;
      margin: 15px 0;
    }

    .tutorial-header {
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--blue-700);
      font-weight: 600;
      margin-bottom: 10px;
    }

    .tutorial-steps {
      list-style: none;
      padding: 0;
      counter-reset: step-counter;
    }

    .tutorial-steps li {
      margin: 8px 0;
      padding-left: 25px;
      position: relative;
      font-size: 0.875rem;
      line-height: 1.5;
    }

    .tutorial-steps li:before {
      content: counter(step-counter);
      counter-increment: step-counter;
      position: absolute;
      left: 0;
      top: 0;
      background: var(--blue-700);
      color: white;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.7rem;
      font-weight: 600;
    }

    .help-button {
      background: var(--blue-700);
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.75rem;
      margin-left: 10px;
    }

    .help-button:hover {
      background: var(--blue-800);
    }

    /* Review Status Indicator */
    .review-indicator {
      background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
      border: 1px solid var(--purple-600);
      border-radius: 6px;
      padding: 12px;
      margin: 10px 0;
      text-align: center;
    }

    .review-indicator .icon {
      font-size: 1.5rem;
      color: var(--purple-600);
      margin-bottom: 5px;
    }

    .review-indicator .text {
      font-size: 0.875rem;
      color: var(--purple-700);
      font-weight: 500;
    }

    /* Notification styles */
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
    }

    .notification.show {
      display: block;
      animation: slideIn 0.3s ease-out;
    }

    .notification.error {
      background: var(--red-600);
    }

    /* Styling untuk tabel selesai */
    .completed-table .btn-drive {
      width: auto;
      min-width: unset;
      padding: 0.2rem 0.4rem;
      font-size: 0.65rem;
      display: inline-block;
      margin-bottom: 0.2rem;
    }

    .completed-table .status-completed {
      background: #d1fae5;
      color: var(--green-700);
      padding: 0.25rem 0.5rem;
      border-radius: 12px;
      font-size: 0.7rem;
      font-weight: 500;
    }

    /* Button revisi dengan warna merah */
    .btn-revisi { 
      background: var(--red-600); 
      color: white; 
    }
    .btn-revisi:hover { 
      background: var(--red-700); 
      color: white; 
    }

    .btn-resubmit { 
      background: var(--orange-600); 
      color: white; 
      padding: 0.25rem 0.5rem; 
      font-size: 0.675rem; 
      border-radius: 3px; 
      text-decoration: none; 
      display: inline-block; 
      text-align: center; 
      min-width: 60px; 
      transition: all 0.2s; 
      border: none; 
      cursor: pointer;
    }
    .btn-resubmit:hover { 
      background: var(--orange-700); 
      color: white; 
    }

    /* Progress item styles for modal */
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

    /* Rating styles */
    .rating-clickable {
      cursor: pointer;
    }

    .rating-clickable:hover {
      transition: transform 0.2s;
    }

    /* Deadline Badge Style */
.deadline-badge {
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-size: 0.65rem;
    font-weight: 600;
    display: inline-block;
    min-width: 40px;
    text-align: center;
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

    @keyframes slideIn {
      from {
        transform: translateX(100%);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

                   /* Navigation Categories - Same styling from original */
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
    <h1  style="margin-top: 30px;" class="select-none">Job Board</h1>
    <p class="subtitle">Kelola semua project yang Anda lamar dan kerjakan dalam satu tempat.</p>

    <!-- Tutorial Button - Moved to top -->
    <div>
        <button class="btn-tutorial" onclick="openTutorialModal()">
            <i class="fas fa-graduation-cap"></i>
            Panduan Freelancer
        </button>
    </div>

    <section class="card">
      <!-- Tabs -->
      <div class="tabs">
        <button type="button" class="tab" data-tab="applied" aria-current="page">Job Board</button>
        <button type="button" class="tab" data-tab="working">Dalam Proses</button>
        <!-- <button type="button" class="tab" data-tab="review">Menunggu Review</button> -->
        <button type="button" class="tab" data-tab="completed">Selesai</button>
      </div>

      <!-- Table: Job Board (Updated with kategori and aksi) -->
      <div class="table-wrap tab-content" id="applied">
        <table class="applied-table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Judul Pekerjaan</th>
              <th>Sub Kategori</th>
              <th>Client</th>
              <th>Budget (Rp)</th>
              <th>Status</th>
              <th>Tanggal Apply</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($proposals->sortBy('created_at') as $proposal)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $proposal->proposal_title }}</td>
              <td>{{ $proposal->project->subcategory ?? '-' }}</td>
              <td>{{ $proposal->project->client->name ?? '-' }}</td>
              <td>{{ number_format($proposal->proposal_price, 0, ',', '.') }}</td>
              <td>
                  @if($proposal->status == 'accepted')
                      <span class="status-badge status-accepted">Diterima</span>
                  @elseif($proposal->status == 'rejected')
                      <span class="status-badge status-rejected">Ditolak</span>
                  @else
                      <span class="status-badge status-pending">Menunggu Persetujuan</span>
                  @endif
              </td>
              <td>{{ $proposal->created_at->format('d/m/Y') }}</td>
              <td>
                <div class="action-buttons">
                  <a href="{{ route('projects.show', $proposal->project->id) }}" class="btn btn-detail">
                    <i class="fas fa-info-circle"></i> Detail
                  </a>
                  @if($proposal->status == 'accepted')
                    @php
                      $isCompleted = $proposal->project->submitProjects()
                          ->where('user_id', auth()->id())
                          ->where('status', 'selesai')
                          ->exists();
                    @endphp
                    @if($isCompleted)
                      <button class="btn btn-results" onclick="showCompletedTab()">
                        <i class="fas fa-check-circle"></i> Lihat Hasil
                      </button>
                    @else
                      <button class="btn btn-monitor" onclick="showWorkingTab()">
                        <i class="fas fa-eye"></i> Pantau Projek
                      </button>
                    @endif
                  @endif
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="8">Belum ada lamaran</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Table: Sedang Dikerjakan (Updated CSS and Actions) -->
      <div class="table-wrap tab-content hidden" id="working">
        <table class="working-table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Judul Pekerjaan</th>
              <th>Client</th>
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
                $acceptedProposal = $project->proposalls()
                  ->where('status', 'accepted')
                  ->where('user_id', auth()->id())
                  ->first();
                
                  // Tambahkan logic deadline
                $deadline = $project->deadline ? \Carbon\Carbon::parse($project->deadline) : null;
                if ($deadline) {
                    if (now()->lessThanOrEqualTo($deadline)) {
                        $deadlineDays = floor(now()->floatDiffInDays($deadline));
                        $deadlineText = 'Sisa ' . substr($deadlineDays, 0, 2) . ' hari';
                        $deadlineClass = 'deadline-upcoming';
                    } else {
                        $deadlineDays = floor($deadline->floatDiffInDays(now()));
                        $deadlineText = 'Terlambat ' . substr($deadlineDays, 0, 2) . ' hari';
                        $deadlineClass = 'deadline-late';
                    }
                } else {
                    $deadlineText = 'Tidak ada deadline';
                    $deadlineClass = 'deadline-upcoming';
                }
              @endphp

              @if($acceptedProposal)
                @php
                  $submitProject = \App\Models\SubmitProject::where('project_id', $project->id)
                    ->where('user_id', auth()->id())
                    ->first();
                    
                  $shouldShowInWorking = true;
                  if ($submitProject && $submitProject->status === 'selesai') {
                    $shouldShowInWorking = false;
                  }
                @endphp

                @if($shouldShowInWorking)
                  @php
                    $allTimelines = $project->timelines;
                    $completedTimelines = $project->timelines->where('status', 'selesai');
                    $isAllCompleted = $allTimelines->count() > 0 && $allTimelines->count() === $completedTimelines->count();
                    $projectProgress = $project->progress ?? 0;
                    $canSubmit = ($projectProgress >= 100) || $isAllCompleted;
                    
                    if (!$submitProject) {
                      $statusDisplay = 'Dalam Proses';
                      $statusClass = 'status-working';
                      $isPending = false;
                      $isRevisi = false;
                    } else {
                      switch($submitProject->status) {
                        case 'pending':
                          $statusDisplay = 'Menunggu Persetujuan';
                          $statusClass = 'status-pending';
                          $isPending = true;
                          $isRevisi = false;
                          break;
                        case 'revisi':
                          $statusDisplay = 'Revisi';
                          $statusClass = 'status-revision';
                          $isPending = false;
                          $isRevisi = true;
                          break;
                        default:
                          $statusDisplay = 'Dalam Proses';
                          $statusClass = 'status-working';
                          $isPending = false;
                          $isRevisi = false;
                      }
                    }
                  @endphp
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->client->name ?? '-' }}</td>
                    <td>
                        <span class="deadline-badge {{ $deadlineClass }}">
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
                      @if($isAllCompleted && !$isPending && !$isRevisi)
                        <br><small style="color: var(--green-600); font-weight: 600; font-size: 0.65rem;">
                          Semua timeline selesai
                        </small>
                      @endif
                    </td>
                    <td>
                      {{ $projectProgress }}%
                      <div class="progress-container">
                        <div class="progress-bar" style="width: {{ $projectProgress }}%"></div>
                      </div>
                    </td>
                    <td>
                      <div class="action-buttons">
                        <!-- Chat button - selalu ada -->
                        <a href="{{ route('chat') }}" class="btn btn-chat">
                          <i class="fas fa-comments"></i> Chat
                        </a>
                        
                        <!-- Lihat Progress - selalu ada -->
                        <button class="btn btn-view" style="background: #5a6986ff;;"onclick="viewProgress({{ $project->id }})">
                          <i class="fas fa-eye"></i> Lihat Progress
                        </button>
                        
                        @if($isRevisi)
                          <!-- Status Revisi: Show Revisi and Submit Ulang buttons -->
                          <button class="btn btn-revisi" onclick="viewRevisionNotes({{ $project->id }}, '{{ addslashes($submitProject->notes ?? '') }}')">
                            <i class="fas fa-exclamation-triangle"></i> Revisi
                          </button>
                          <button class="btn btn-resubmit" onclick="resubmitFinalWork({{ $project->id }})">
                            <i class="fas fa-redo"></i> Submit Ulang
                          </button>
                          
                        @elseif($isPending)
                          <!-- Status Pending: Menunggu review client info -->
                          <span style="font-size: 0.65rem; color: var(--gray-500); font-style: italic; padding: 0.25rem; background: #f9fafb; border-radius: 3px;">
                            <i class="fas fa-clock"></i> Menunggu Persetujuan client
                          </span>

                        @else
                          <!-- Status Dalam Proses: Show Upload and Submit buttons -->
                          <!-- Ganti bagian select yang ada dengan ini -->
                          @if($project->timelines->where('status', '!=', 'selesai')->count() > 0)
                            <select id="timeline-select-{{ $project->id }}" class="timeline-select">
                              <option value="">Pilih Timeline</option>
                              @foreach($project->timelines->where('status', '!=', 'selesai') as $timeline)
                                <option value="{{ $timeline->id }}">
                                  {{ Str::limit($timeline->description, 15) }}
                                </option>
                              @endforeach
                            </select>
                            <button class="btn btn-upload" onclick="uploadProgress({{ $project->id }})">
                              <i class="fas fa-upload"></i> Upload
                            </button>
                          @endif
                          
                          <button class="btn btn-submit {{ !$canSubmit ? 'btn-submit:disabled' : '' }}" 
                                  onclick="submitFinalWork({{ $project->id }})"
                                  {{ !$canSubmit ? 'disabled title="Selesaikan semua timeline atau capai progress 100% untuk submit"' : '' }}>
                            <i class="fas fa-paper-plane"></i> Submit
                          </button>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endif
              @endif
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Table: Menunggu Review -->
      <div class="table-wrap tab-content hidden" id="review">
        <table class="review-table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Judul Pekerjaan</th>
              <th>Client</th>
              <th>Status Review</th>
              <th>Tanggal Submit</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Video Promosi Produk</td>
              <td>PT Marketing Pro</td>
              <td><span class="status-badge status-review">Sedang Direview</span></td>
              <td>25/08/2025</td>
              <td>
                <div class="action-buttons">
                  <a href="#" class="btn btn-view" onclick="viewSubmittedWork(1)"><i class="fas fa-eye"></i> Lihat</a>
                  <a href="{{ route('chat') }}" class="btn btn-chat"><i class="fas fa-comments"></i> Chat</a>
                </div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Desain Kemasan Produk</td>
              <td>Brand Creative</td>
              <td><span class="status-badge status-revision">Perlu Revisi</span></td>
              <td>23/08/2025</td>
              <td>
                <div class="action-buttons">
                  <a href="#" class="btn btn-revisi" onclick="viewRevisionNotes(2)"><i class="fas fa-exclamation-triangle"></i> Revisi</a>
                  <a href="{{ route('chat') }}" class="btn btn-chat"><i class="fas fa-comments"></i> Chat</a>
                  <a href="#" class="btn btn-upload" onclick="uploadRevision(2)"><i class="fas fa-upload"></i> Upload</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Table: Selesai (Updated with File Progress and File Hasil columns) -->
<div class="table-wrap tab-content hidden" id="completed">
  <table class="completed-table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Judul Pekerjaan</th>
        <th>Client</th>
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
            ->where('user_id', auth()->id())
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
        @endphp
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $submission->project->title ?? '-' }}</td>
          <td>{{ $submission->project->client->name ?? '-' }}</td>
          <td>
            Rp {{ number_format($acceptedProposal->proposal_price ?? 0, 0, ',', '.') }}
          </td>
          <td>{{ $submission->updated_at->format('d/m/Y') }}</td>
          <td>
            <div style="color: var(--yellow-600); cursor: pointer;" class="rating-clickable" onclick="showRatingModal({{ $submission->id }})">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              (5.0)
            </div>
          </td>
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
          <td colspan="9" style="text-align: center; padding: 2rem; color: var(--gray-500);">
            Belum ada project yang selesai
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

    </section>
  </main>

  <!-- Progress Modal -->
  <div id="progressModal" class="modal">
    <div class="modal-content">

      <div id="progressContent"></div>
    </div>
  </div>

  <!-- Upload Progress Modal -->
  <div id="uploadProgressModal" class="modal">
    <div class="modal-content">

      <div id="uploadProgressContent">
        <!-- Content will be loaded dynamically -->
      </div>
    </div>
  </div>

  <!-- Submit Final Work Modal -->
  <div id="submitFinalModal" class="modal">
    <div class="modal-content">

      <div id="submitFinalContent">
        <!-- Content will be loaded dynamically -->
      </div>
    </div>
  </div>

  <!-- View Revision Notes Modal -->
  <div id="revisionModal" class="modal">
    <div class="modal-content">

      <div id="revisionContent">
        <!-- Content will be loaded dynamically -->
      </div>
    </div>
  </div>

  <!-- Rating Modal -->
  <div id="ratingModal" class="modal">
    <div class="modal-content">

      <div id="ratingContent">
        <!-- Content will be loaded dynamically -->
      </div>
    </div>
  </div>

  <!-- Tutorial Modal -->
<div id="tutorialModal" class="modal tutorial-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Panduan Freelancer - Job Board</h2>
            <span class="close" onclick="closeModal('tutorialModal')">&times;</span>
        </div>
        <div class="tutorial-content">
            <div class="tutorial-steps">
                <div class="tutorial-step">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <div class="step-title">Cari dan Lamar Project</div>
                            <div class="step-description">
                                Browse project yang tersedia dan kirim proposal terbaik Anda. Pastikan portfolio dan harga kompetitif.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tutorial-step">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <div class="step-title">Monitor Status Lamaran</div>
                            <div class="step-description">
                                Di tab "Job Board", pantau status lamaran Anda. Jika diterima, project akan pindah ke tab "Dalam Proses".
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tutorial-step">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <div class="step-title">Kerjakan dan Upload Progress</div>
                            <div class="step-description">
                                Pilih timeline, upload progress secara berkala dengan link file. Pastikan memenuhi deadline yang ditetapkan.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tutorial-step">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <div class="step-title">Submit Hasil Akhir</div>
                            <div class="step-description">
                                Setelah semua timeline selesai, submit hasil akhir ke client untuk review dan persetujuan.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tutorial-step">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <div class="step-title">Kelola Revisi & Rating</div>
                            <div class="step-description">
                                Jika ada revisi, perbaiki sesuai catatan client. Project selesai akan masuk ke tab "Selesai" dengan rating client.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--gray-200); text-align: center;">
                <p style="color: var(--gray-600); font-size: 0.9rem;">
                    <i class="fas fa-lightbulb" style="color: var(--yellow-600); margin-right: 0.5rem;"></i>
                    <strong>Tip:</strong> Komunikasi yang baik dan update progress rutin akan meningkatkan rating Anda!
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// JAVASCRIPT LENGKAP FIXED - Ganti semua JavaScript modal yang ada

// Modal handling - Updated untuk design baru
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

// Tutorial Modal Function - FIXED
function openTutorialModal() {
    openModal('tutorialModal');
}

// Progress Modal - Updated dengan design baru
function viewProgress(projectId) {
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
            <span class="close" onclick="closeModal('progressModal')">&times;</span>
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
        if (!response.ok) throw new Error(`HTTP ${response.status}: ${response.statusText}`);
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
                    <p class="modal-subtitle">Detail progress pekerjaan Anda</p>
                </div>
                <span class="close" onclick="closeModal('progressModal')">&times;</span>
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
                } else if (link.url.includes('figma.com')) {
                    iconClass = 'fab fa-figma';
                    iconBg = 'linear-gradient(135deg, #8b5cf6, #7c3aed)';
                } else if (link.url.includes('github.com')) {
                    iconClass = 'fab fa-github';
                    iconBg = 'linear-gradient(135deg, #6b7280, #4b5563)';
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
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4 class="empty-title">Belum ada Progress Links</h4>
                    <p class="empty-description">
                        Anda belum mengupload link progress untuk project ini.
                    </p>
                </div>
            `;
        }

        content += `
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('progressModal')">
                    <i class="fas fa-times"></i>
                    Tutup
                </button>
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
                    <p class="modal-subtitle">Terjadi kesalahan saat memuat data</p>
                </div>
                <span class="close" onclick="closeModal('progressModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="empty-state">
                    <div class="empty-icon" style="color: #ef4444;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h4 class="empty-title">Error Loading Progress</h4>
                    <p class="empty-description">${error.message}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('progressModal')">
                    <i class="fas fa-times"></i>
                    Tutup
                </button>
            </div>
        `;
        showNotification('Gagal memuat progress: ' + error.message, 'error');
    });
}

// Upload Progress - FIXED button selector
function uploadProgress(projectId) {
    const timelineSelect = document.getElementById(`timeline-select-${projectId}`);
    const timelineId = timelineSelect.value;

    if (!timelineId) {
        alert('Pilih timeline terlebih dahulu!');
        return;
    }

    const timelineText = timelineSelect.options[timelineSelect.selectedIndex].text;

    const content = `
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-upload"></i>
                    Upload Progress Pekerjaan
                </h2>
                <p class="modal-subtitle">Timeline: ${timelineText}</p>
            </div>
            <span class="close" onclick="closeModal('uploadProgressModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form id="progressForm" onsubmit="submitProgress(event, ${projectId}, ${timelineId})">
                <div class="form-group">
                    <label class="form-label">Deskripsi Progress</label>
                    <textarea class="form-input form-textarea" name="description" 
                        placeholder="Jelaskan apa yang telah dikerjakan..." rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Link Progress <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="url" class="form-input" name="link_url" placeholder="https://example.com/..." required>
                    <small style="color: #64748b; font-size: 0.75rem;">
                        Link bisa dari Google Drive, Dropbox, Github, atau platform lain.
                    </small>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('uploadProgressModal')">
                <i class="fas fa-times"></i>
                Batal
            </button>
            <button type="submit" form="progressForm" class="btn btn-primary">
                <i class="fas fa-upload"></i>
                Kirim Progress Update
            </button>
        </div>
    `;

    document.getElementById('uploadProgressContent').innerHTML = content;
    openModal('uploadProgressModal');
}

// Submit Final Work - FIXED
function submitFinalWork(projectId) {
    const content = `
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-paper-plane"></i>
                    Submit Hasil Akhir Pekerjaan
                </h2>
                <p class="modal-subtitle">Setelah submit, pekerjaan akan dikirim ke client untuk direview</p>
            </div>
            <span class="close" onclick="closeModal('submitFinalModal')">&times;</span>
        </div>
        <div class="modal-body">
            <div style="background: #e0e7ff; border-left: 4px solid #3b82f6; padding: 15px; margin-bottom: 24px; border-radius: 8px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-info-circle" style="color: #3b82f6;"></i>
                    <strong style="color: #1e40af;">Info Penting:</strong>
                </div>
                <p style="color: #1e3a8a; margin: 8px 0 0 0; font-size: 14px;">
                    Setelah submit, pekerjaan akan dikirim ke client untuk direview. Pastikan semua file sudah sesuai requirement.
                </p>
            </div>

            <form id="finalSubmitForm-${projectId}" onsubmit="submitFinalResult(event, ${projectId})">
                <input type="hidden" name="project_id" value="${projectId}">
                
                <div class="form-group">
                    <label class="form-label">
                        Link Hasil Pekerjaan <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea class="form-input form-textarea" name="links" 
                        placeholder="Masukkan link Google Drive, Dropbox, GitHub, atau link lainnya (satu link per baris)..." 
                        rows="3" required></textarea>
                    <small style="color: #64748b; font-size: 0.75rem;">
                        Masukkan link file hasil pekerjaan dari cloud storage. Jika link lebih dari 1, enter untuk menambahkan link berikutnya.
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Deskripsi Hasil Pekerjaan <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea class="form-input form-textarea" name="description" 
                        placeholder="Jelaskan hasil pekerjaan yang Anda kirimkan..." rows="4" required></textarea>
                    <small style="color: #64748b; font-size: 0.75rem;">
                        Input minimal 50 karakter
                    </small>
                </div>

                <div style="background: #f0f9ff; padding: 15px; border-radius: 6px; margin: 15px 0; font-size: 0.875rem;">
                    <strong>📋 Checklist Sebelum Submit:</strong>
                    <ul style="margin: 10px 0; padding-left: 20px;">
                        <li>Link file hasil pekerjaan sudah benar dan dapat diakses</li>
                        <li>Hasil sesuai dengan requirement yang diminta</li>
                        <li>File dalam format yang benar dan dapat dibuka</li>
                        <li>Deskripsi sudah menjelaskan hasil pekerjaan dengan jelas</li>
                    </ul>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('submitFinalModal')">
                <i class="fas fa-times"></i>
                Batal
            </button>
            <button type="submit" form="finalSubmitForm-${projectId}" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i>
                Submit Hasil Akhir
            </button>
        </div>
    `;

    document.getElementById('submitFinalContent').innerHTML = content;
    openModal('submitFinalModal');
}

// View Revision Notes - FIXED
function viewRevisionNotes(projectId, clientNotes) {
    if (!clientNotes || clientNotes.trim() === '') {
        fetch(`/submit-projects/revision-notes/${projectId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            displayRevisionModal(projectId, data.notes || 'Tidak ada catatan khusus dari client.');
        })
        .catch(error => {
            console.error('Error fetching revision notes:', error);
            displayRevisionModal(projectId, 'Tidak dapat memuat catatan revisi.');
        });
    } else {
        displayRevisionModal(projectId, clientNotes);
    }
}

function displayRevisionModal(projectId, notes) {
    const content = `
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Catatan Revisi dari Client
                </h2>
                <p class="modal-subtitle">Silakan perbaiki sesuai feedback client</p>
            </div>
            <span class="close" onclick="closeModal('revisionModal')">&times;</span>
        </div>
        <div class="modal-body">
            <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin-bottom: 24px; border-radius: 8px;">
                <h4 style="color: #dc2626; margin: 0 0 10px 0;">Feedback Client:</h4>
                <div style="margin: 0; line-height: 1.6; color: #991b1b; white-space: pre-wrap; word-wrap: break-word;">
                    ${notes}
                </div>
            </div>

            <div style="background: #fffbeb; border-left: 4px solid #f59e0b; padding: 15px; margin: 15px 0; border-radius: 4px;">
                <h5 style="color: #d97706; margin: 0 0 8px 0;">
                    <i class="fas fa-lightbulb"></i> Tips untuk Revisi:
                </h5>
                <ul style="margin: 0; padding-left: 20px; color: #92400e; font-size: 0.875rem;">
                    <li>Baca feedback dengan teliti</li>
                    <li>Pastikan semua poin revisi sudah diperbaiki</li>
                    <li>Test hasil revisi sebelum submit ulang</li>
                    <li>Komunikasikan jika ada yang kurang jelas</li>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('revisionModal')">
                <i class="fas fa-times"></i>
                Tutup
            </button>
            <button type="button" class="btn btn-primary" onclick="closeModal('revisionModal'); resubmitFinalWork(${projectId});">
                <i class="fas fa-upload"></i>
                Upload Hasil Revisi
            </button>
        </div>
    `;

    document.getElementById('revisionContent').innerHTML = content;
    openModal('revisionModal');
}

// Resubmit Final Work - FIXED
function resubmitFinalWork(projectId) {
    const content = `
        <div class="modal-header">
            <div class="modal-title-section">
                <h2 class="modal-title">
                    <i class="fas fa-sync-alt"></i>
                    Submit Ulang Hasil Revisi
                </h2>
                <p class="modal-subtitle">Submit ulang hasil revisi untuk direview ulang oleh client</p>
            </div>
            <span class="close" onclick="closeModal('submitFinalModal')">&times;</span>
        </div>
        <div class="modal-body">
            <div style="background: #fef2f2; border-left: 4px solid #f59e0b; padding: 15px; margin-bottom: 24px; border-radius: 8px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-sync-alt" style="color: #f59e0b;"></i>
                    <strong style="color: #d97706;">Submit Ulang Revisi:</strong>
                </div>
                <p style="color: #92400e; margin: 8px 0 0 0; font-size: 14px;">
                    Submit ulang hasil revisi untuk direview ulang oleh client
                </p>
            </div>

            <form id="finalSubmitForm-${projectId}" onsubmit="submitFinalResult(event, ${projectId})">
                <input type="hidden" name="project_id" value="${projectId}">
                
                <div class="form-group">
                    <label class="form-label">
                        Link Hasil Revisi <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea class="form-input form-textarea" name="links" 
                        placeholder="Masukkan link Google Drive, Dropbox, GitHub, atau link lainnya (satu link per baris)..." 
                        rows="3" required></textarea>
                    <small style="color: #64748b; font-size: 0.75rem;">
                        Masukkan link file hasil revisi dari cloud storage
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Deskripsi Hasil Revisi <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea class="form-input form-textarea" name="description" 
                        placeholder="Jelaskan perubahan yang telah Anda lakukan berdasarkan feedback client..." rows="4" required></textarea>
                    <small style="color: #64748b; font-size: 0.75rem;">
                        Input minimal 50 karakter
                    </small>
                </div>

                <div style="background: #fffbeb; padding: 15px; border-radius: 6px; margin: 15px 0; font-size: 0.875rem; border-left: 4px solid #f59e0b;">
                    <strong>📋 Checklist Sebelum Resubmit:</strong>
                    <ul style="margin: 10px 0; padding-left: 20px;">
                        <li>Perubahan sudah sesuai dengan feedback client</li>
                        <li>Link file hasil revisi sudah benar dan dapat diakses</li>
                        <li>Deskripsi sudah menjelaskan perubahan yang dilakukan</li>
                        <li>File dalam format yang benar dan dapat dibuka</li>
                    </ul>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('submitFinalModal')">
                <i class="fas fa-times"></i>
                Batal
            </button>
            <button type="submit" form="finalSubmitForm-${projectId}" class="btn btn-primary" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                <i class="fas fa-paper-plane"></i>
                Submit Ulang Revisi
            </button>
        </div>
    `;

    document.getElementById('submitFinalContent').innerHTML = content;
    openModal('submitFinalModal');
}

// Show Rating Modal - FIXED
function showRatingModal(submissionId) {
    const ratingContent = document.getElementById('ratingContent');
    
    const ratingData = {
        rating: 5.0,
        review: "Pekerjaan sangat memuaskan! Freelancer sangat profesional, tepat waktu, dan hasil kerja melebihi ekspektasi. Komunikasi juga sangat baik sepanjang project berlangsung. Highly recommended!",
        client_name: "PT Marketing Pro",
        project_title: "Video Promosi Produk",
        date: "28/08/2025"
    };

    const content = `
        <div style="text-align: center; margin-bottom: 25px;">
            <div style="font-size: 3rem; color: #f59e0b; margin-bottom: 10px;">
                ${generateStars(ratingData.rating)}
            </div>
            <div style="font-size: 1.5rem; font-weight: 600; color: #3b82f6; margin-bottom: 5px;">
                ${ratingData.rating}/5.0
            </div>
            <div style="color: #64748b; font-size: 0.875rem;">
                Project: ${ratingData.project_title}
            </div>
            <div style="color: #64748b; font-size: 0.75rem;">
                ${ratingData.date}
            </div>
        </div>

        <div style="background: #f8fafc; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <i class="fas fa-quote-left" style="color: #3b82f6; margin-right: 10px; font-size: 1.2rem;"></i>
                <strong style="color: #374151;">Review dari ${ratingData.client_name}</strong>
            </div>
            <p style="line-height: 1.6; color: #374151; margin: 0; font-style: italic;">
                "${ratingData.review}"
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin: 20px 0;">
            <div style="text-align: center; padding: 15px; background: #f0f9ff; border-radius: 6px;">
                <i class="fas fa-clock" style="color: #3b82f6; margin-bottom: 8px; font-size: 1.2rem;"></i>
                <div style="font-size: 0.75rem; color: #64748b;">Ketepatan Waktu</div>
                <div style="font-weight: 600; color: #3b82f6;">Excellent</div>
            </div>
            <div style="text-align: center; padding: 15px; background: #f0fdf4; border-radius: 6px;">
                <i class="fas fa-thumbs-up" style="color: #10b981; margin-bottom: 8px; font-size: 1.2rem;"></i>
                <div style="font-size: 0.75rem; color: #64748b;">Kualitas Kerja</div>
                <div style="font-weight: 600; color: #10b981;">Outstanding</div>
            </div>
        </div>
    `;

    ratingContent.innerHTML = content;
    openModal('ratingModal');
}

// Helper function to generate star display
function generateStars(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    let stars = '';
    
    for (let i = 0; i < fullStars; i++) {
        stars += '<i class="fas fa-star"></i>';
    }
    
    if (hasHalfStar) {
        stars += '<i class="fas fa-star-half-alt"></i>';
    }
    
    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    for (let i = 0; i < emptyStars; i++) {
        stars += '<i class="far fa-star"></i>';
    }
    
    return stars;
}

// Submit Progress - FIXED dengan button selector yang benar
function submitProgress(event, projectId, timelineId) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    const link = formData.get('link_url');
    try {
        new URL(link);
    } catch {
        showNotification('Masukkan link yang valid!', 'error');
        return;
    }

    // FIXED: Cari button di modal footer yang tepat
    const submitButton = document.querySelector('#uploadProgressModal .modal-footer .btn-primary');
    if (!submitButton) {
        console.error('Submit button tidak ditemukan');
        showNotification('Terjadi kesalahan sistem. Silakan refresh halaman.', 'error');
        return;
    }
    
    const originalButtonText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    submitButton.disabled = true;

    const progressData = {
        project_id: projectId,
        timeline_id: timelineId,
        description: formData.get('description'),
        link_url: formData.get('link_url')
    };

    fetch('/progress/store', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(progressData)
    })
    .then(response => {
        return response.json().then(data => ({
            status: response.status,
            ok: response.ok,
            data: data
        }));
    })
    .then(result => {
        submitButton.innerHTML = originalButtonText;
        submitButton.disabled = false;

        if (result.ok && result.data.success) {
            showNotification(result.data.message || 'Progress berhasil diupload!', 'success');
            closeModal('uploadProgressModal');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            const errorMessage = result.data.message || 'Gagal upload progress!';
            showNotification(errorMessage, 'error');
        }
    })
    .catch(error => {
        submitButton.innerHTML = originalButtonText;
        submitButton.disabled = false;
        console.error('Network Error:', error);
        showNotification('Terjadi kesalahan jaringan. Silakan coba lagi.', 'error');
    });
}

// Submit Final Result - FIXED dengan button selector yang benar  
function submitFinalResult(event, projectId) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    const description = formData.get('description');
    if (!description || description.trim().length < 10) {
        showNotification('Deskripsi harus diisi minimal 10 karakter!', 'error');
        return;
    }

    const links = formData.get('links');
    if (!links || links.trim().length < 5) {
        showNotification('Link hasil pekerjaan harus diisi!', 'error');
        return;
    }

    // FIXED: Cari button di modal footer yang tepat
    const submitButton = document.querySelector('#submitFinalModal .modal-footer .btn-primary');
    if (!submitButton) {
        console.error('Submit button tidak ditemukan');
        showNotification('Terjadi kesalahan sistem. Silakan refresh halaman.', 'error');
        return;
    }
    
    const originalButtonText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    submitButton.disabled = true;

    fetch('/submit-projects', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error response body:', text);
                throw new Error(`HTTP ${response.status}: ${text.substring(0, 200)}`);
            });
        }
        
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.includes("application/json")) {
            return response.json();
        } else {
            return response.text().then(text => {
                console.log('Non-JSON response:', text);
                throw new Error('Server response bukan JSON: ' + text.substring(0, 200));
            });
        }
    })
    .then(data => {
        submitButton.innerHTML = originalButtonText;
        submitButton.disabled = false;

        if (data.success) {
            showNotification(data.message || 'Hasil pekerjaan berhasil disubmit!', 'success');
            closeModal('submitFinalModal');
            setTimeout(() => location.reload(), 1500);
        } else {
            let errorMessage = data.message || 'Gagal submit hasil pekerjaan!';
            
            if (data.errors) {
                const firstError = Object.values(data.errors)[0];
                errorMessage = firstError[0] || errorMessage;
            }
            
            showNotification(errorMessage, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        submitButton.innerHTML = originalButtonText;
        submitButton.disabled = false;
        
        let errorMessage = 'Gagal mengirim data: ';
        
        if (error.message.includes('project_id')) {
            errorMessage += 'Project ID tidak valid';
        } else if (error.message.includes('description')) {
            errorMessage += 'Deskripsi tidak valid';
        } else if (error.message.includes('HTTP 422')) {
            errorMessage += 'Data form tidak lengkap';
        } else if (error.message.includes('HTTP 500')) {
            errorMessage += 'Error server internal';
        } else {
            errorMessage += error.message.substring(0, 100);
        }
        
        showNotification(errorMessage, 'error');
    });
}

// Tab switching functions - EXISTING
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

// Notification function - EXISTING
function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    const messageEl = document.getElementById('notificationMessage');
    if (!notification || !messageEl) return;

    messageEl.textContent = message;
    notification.className = `notification show ${type}`;
    setTimeout(() => notification.classList.remove('show'), 3000);
}

// Event listeners - Complete setup
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality - EXISTING
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

    // Close modal when clicking outside
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal(modal.id);
            }
        });
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModals = document.querySelectorAll('.modal.show');
            openModals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });

    // Initialize tooltips for status badges
    const statusBadges = document.querySelectorAll('.status-badge');
    statusBadges.forEach(badge => {
        badge.title = badge.textContent;
    });
});
</script>

</body>
</html>
@endsection