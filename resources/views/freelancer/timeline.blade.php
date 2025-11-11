@extends('client.layout.client-layout')
@section('title', 'Timeline - Freelancer untuk Pembuatan Website E-Commerce - CariFreelance')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timeline Calendar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin-top: 70px;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            background-color: #fafbfc;
            padding: 20px;
        }

        .timeline-calendar-section {
            background: white;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            border: 1px solid #e1e8ed;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e1e8ed;
        }

        .section-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .section-header i {
            font-size: 20px;
            color: #1d9bf0;
        }

        .section-description {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 32px;
            line-height: 1.5;
        }

        .date-selection-indicator {
            background: linear-gradient(135deg, #ddd6fe, #c7d2fe);
            border: 2px solid #8b5cf6;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-selection-indicator i {
            font-size: 20px;
            color: #7c3aed;
        }

        .date-selection-text {
            flex: 1;
        }

        .date-selection-title {
            font-weight: 700;
            color: #5b21b6;
            margin-bottom: 4px;
        }

        .date-selection-desc {
            font-size: 14px;
            color: #6d28d9;
        }

        .deadline-warning {
            background: linear-gradient(135deg, #fef3c7, #fed7aa);
            border: 2px solid #f59e0b;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .deadline-warning i {
            font-size: 20px;
            color: #d97706;
        }

        .deadline-warning-text {
            flex: 1;
        }

        .deadline-warning-title {
            font-weight: 700;
            color: #92400e;
            margin-bottom: 4px;
        }

        .deadline-warning-desc {
            font-size: 14px;
            color: #a16207;
        }

        .calendar-container {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            margin: 0 auto 32px auto;
            max-width: 600px;
            position: relative;
            overflow: hidden;
        }

        .calendar-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1d9bf0, #0ea5e9, #06b6d4);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .month-selector, .year-selector {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .month-selector:hover, .year-selector:hover {
            border-color: #1d9bf0;
            box-shadow: 0 0 0 3px rgba(29, 155, 240, 0.1);
        }

        .calendar-info {
            text-align: right;
        }

        .project-duration {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .timeline-weeks {
            font-size: 18px;
            font-weight: 700;
            color: #1d9bf0;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: white;
            border-radius: 12px;
            padding: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        .calendar-day-header {
            text-align: center;
            padding: 12px 4px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .calendar-day {
            background-color: #ffffff;
            color: #1a1a1a;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            margin: 1px;
            user-select: none;
            min-height: 35px;
        }

        .calendar-day.other-month {
            color: #d1d5db;
        }

        .calendar-day.today:not(.selected-date) {
            background-color: #249cfdff;
            border: 2px solid #3b82f6;
            color: #10296bff;
            font-weight: bold;
        }

        .calendar-day.deadline:not(.selected-date) {
            background-color: #ff5353ff;
            border: 2px dashed #ef4444;
            color: #831c1cff;
            font-weight: bold;
            position: relative;
        }

        .calendar-day.deadline:not(.selected-date)::after {
            content: "⚠";
            position: absolute;
            top: 2px;
            right: 4px;
            font-size: 10px;
        }

        .calendar-day.selected-date {
            background-color: #16a34a !important;
            color: white !important;
            border: 2px solid #16a34a !important;
            font-weight: bold;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.4);
            position: relative;
        }

        .calendar-day.deadline::after {
            content: '⚠';
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 16px;
            height: 16px;
            background: #f59e0b;
            color: white;
            border-radius: 50%;
            font-size: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
        }

        .calendar-day.saved-milestone {
            background-color: #16a34a !important;
            color: white !important;
            font-weight: 700;
            position: relative;
            z-index: 10;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.6) !important;
        }

        .calendar-day.saved-milestone::before {
            content: '✓';
            position: absolute;
            top: -2px;
            left: -2px;
            width: 16px;
            height: 16px;
            background: #15803d;
            color: white;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
        }

        .calendar-day.selected-date:hover {
            background-color: #15803d !important;
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.7) !important;
            z-index: 20;
        }

        .calendar-day.saved-milestone:hover {
            background-color: #15803d !important;
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.7) !important;
            z-index: 20;
        }

        .calendar-day.past-date,
        .calendar-day.disabled {
            background-color: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed !important;
        }

        .calendar-day.past-deadline {
            background: #fca5a5;
            color: #7f1d1d;
            cursor: not-allowed;
        }

        .calendar-day.past-deadline:hover {
            transform: none;
            background: #fca5a5;
        }

        .existing-milestones-section {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .existing-milestones-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #e2e8f0;
        }

        .existing-milestones-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .existing-milestones-title h4 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
        }

        .existing-milestones-title i {
            color: #16a34a;
            font-size: 20px;
        }

        .milestone-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .milestone-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #16a34a, #15803d);
        }

        .milestone-card:hover {
            border-color: #16a34a;
            box-shadow: 0 8px 24px rgba(22, 163, 74, 0.15);
            transform: translateY(-2px);
        }

        .milestone-card.completed {
            border-color: #16a34a;
        }

        .milestone-card.completed::before {
            background: linear-gradient(180deg, #16a34a, #15803d);
        }

        .milestone-card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
        }

        .milestone-card-number {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #16a34a, #15803d);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
        }

        .milestone-card-info h5 {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .milestone-card-date {
            font-size: 14px;
            color: #16a34a;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .milestone-card-days {
            font-size: 12px;
            color: #6b7280;
        }

        .milestone-status-badge {
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .milestone-status-badge.completed {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #166534;
            border: 1px solid #16a34a;
        }

        .milestone-status-badge.pending {
            background: linear-gradient(135deg, #fef3c7, #fed7aa);
            color: #92400e;
            border: 1px solid #f59e0b;
        }

        .milestone-card-description {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            font-size: 14px;
            line-height: 1.6;
            color: #334155;
            white-space: pre-line;
        }

        .selected-dates-container {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .selected-dates-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .selected-dates-header h4 {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .selected-dates-header i {
            color: #15803d;
        }

        .selected-dates-display {
            background: white;
            border: 2px solid #1d9bf0;
            border-radius: 12px;
            padding: 16px;
            margin-top: 16px;
        }

        .selected-dates-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .selected-date-tag {
            background: linear-gradient(135deg, #1d9bf0, #1d9bf0);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .confirm-selection-btn {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
        }

        .confirm-selection-btn:hover {
            background: linear-gradient(135deg, #15803d, #166534);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
        }

        .confirm-selection-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .timeline-progress {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
        }

        .progress-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .progress-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .progress-text {
            font-size: 14px;
            color: #6b7280;
        }

        .progress-value {
            font-size: 18px;
            font-weight: 700;
            color: #1d9bf0;
        }

        .milestones-container {
            margin-top: 32px;
        }

        .milestone-item {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 24px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .milestone-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(180deg, #1d9bf0, #06b6d4);
        }

        .milestone-item:hover {
            border-color: #1d9bf0;
            box-shadow: 0 12px 32px rgba(29, 155, 240, 0.15);
            transform: translateY(-4px);
        }

        .milestone-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
        }

        .milestone-title-section {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .milestone-number {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #1d9bf0, #0ea5e9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(29, 155, 240, 0.3);
        }

        .milestone-info h4 {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 6px;
        }

        .milestone-date {
            font-size: 16px;
            color: #1d9bf0;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .milestone-days {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
        }

        .milestone-status {
            padding: 8px 16px;
            border-radius: 24px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #ede9fe, #ddd6fe);
            color: #7c3aed;
            border: 1px solid #c4b5fd;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .form-label i {
            color: #1d9bf0;
            font-size: 18px;
        }

        .form-textarea {
            width: 100%;
            padding: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            line-height: 1.6;
            color: #1a1a1a;
            background: #fafbfc;
            transition: all 0.3s ease;
            min-height: 180px;
            resize: vertical;
            font-family: inherit;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #1d9bf0;
            box-shadow: 0 0 0 4px rgba(29, 155, 240, 0.1);
            background: white;
        }

        .form-textarea:hover {
            border-color: #94a3b8;
            background: white;
        }

        .form-help {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            margin-top: 12px;
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        .form-help-title {
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-example {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 14px;
            margin-top: 12px;
            font-size: 13px;
            color: #0c4a6e;
            line-height: 1.5;
        }

        .form-example-title {
            font-weight: 600;
            margin-bottom: 6px;
            color: #0369a1;
        }

        .char-counter {
            text-align: right;
            font-size: 12px;
            color: #6b7280;
            margin-top: 8px;
        }

        .char-counter.warning {
            color: #f59e0b;
        }

        .char-counter.error {
            color: #dc2626;
        }

        .submit-section {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 32px;
            margin-top: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .submit-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #16a34a, #15803d, #166534);
        }

        .submit-section h4 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1a1a1a;
        }

        .submit-section p {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 28px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .submit-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-top: 24px;
        }

        .btn {
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
            justify-content: center;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white;
            border: 2px solid transparent;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #4b5563, #374151);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(75, 85, 99, 0.4);
        }

        .btn-primary {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
            border: 2px solid transparent;
            box-shadow: 0 4px 16px rgba(22, 163, 74, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #15803d, #166534);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(22, 163, 74, 0.4);
        }

        .btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        @media (max-width: 768px) {
            body {
                margin-top: 50px;
                padding: 12px;
            }

            .timeline-calendar-section {
                padding: 20px;
            }

            .calendar-container {
                padding: 16px;
            }

            .calendar-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .calendar-nav {
                width: 100%;
                justify-content: center;
            }

            .calendar-info {
                text-align: left;
                width: 100%;
            }

            .milestone-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .milestone-item {
                padding: 20px;
            }

            .timeline-progress {
                flex-wrap: wrap;
                gap: 16px;
            }

            .progress-info {
                min-width: calc(50% - 8px);
            }

            .submit-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }

            .existing-milestones-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(29, 155, 240, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(29, 155, 240, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(29, 155, 240, 0);
            }
        }

        .success-bounce {
            animation: successBounce 0.6s ease-in-out;
        }

        @keyframes successBounce {
            0%, 20%, 60%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            80% {
                transform: translateY(-5px);
            }
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1000;
            opacity: 0;
            transform: translateY(-20px);
            animation: slideIn 0.5s forwards;
        }

        .notification.success {
            background: linear-gradient(135deg, #16a34a, #15803d);
        }

        .notification.error {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .notification.info {
            background: linear-gradient(135deg, #1d9bf0, #0ea5e9);
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
    <form id="timelineForm" action="{{ route('timelines.store', $project->id) }}" method="POST">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="type" value="{{ $project->timeline_type }}">
        <input type="hidden" name="title" value="{{ $project->title }}">

        <div class="timeline-calendar-section">
            <div class="section-header">
                <i class="fas fa-calendar-alt"></i>
                <h3>Timeline Pengerjaan & Milestone</h3>
            </div>
            <p class="section-description">
                Pilih tanggal-tanggal untuk milestone project ini. Anda dapat memilih beberapa tanggal sesuai kebutuhan project, 
                kemudian menentukan target untuk setiap tanggal yang dipilih. <strong>Setiap milestone wajib berisi deskripsi minimal 50 karakter</strong> 
                untuk memastikan detail yang memadai.
            </p>

            <div class="date-selection-indicator" id="dateSelectionIndicator">
                <i class="fas fa-calendar-check"></i>
                <div class="date-selection-text">
                    <div class="date-selection-title">Mode: Pemilihan Tanggal Milestone</div>
                    <div class="date-selection-desc">
                        Klik pada tanggal-tanggal di kalender untuk memilih jadwal milestone. Anda dapat memilih lebih dari satu tanggal.
                    </div>
                </div>
            </div>

            <div class="deadline-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <div class="deadline-warning-text">
                    <div class="deadline-warning-title">Perhatian Deadline Project</div>
                    <div class="deadline-warning-desc">
                        Project harus selesai pada 
                        <strong id="deadlineWarningText"></strong>
                        Pastikan tanggal milestone yang dipilih tidak melebihi deadline project.
                    </div>
                </div>
            </div>

            <div class="timeline-progress">
                <div class="progress-info">
                    <div class="progress-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div>
                        <div class="progress-text">Tanggal Dipilih</div>
                        <div class="progress-value" id="selectedDatesCount">0 Tanggal</div>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div>
                        <div class="progress-text">Total Milestone</div>
                        <div class="progress-value" id="totalMilestonesDisplay">0 Target</div>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <div class="progress-text">Deadline</div>
                        <div class="progress-value" id="projectDeadlineDisplay"></div>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <div class="progress-text">Status</div>
                        <div class="progress-value" id="statusDisplay">Pilih Tanggal</div>
                    </div>
                </div>
            </div>

            <div class="calendar-container">
                <div class="calendar-header">
                    <div class="calendar-nav">
                        <select class="month-selector" id="monthSelector">
                            <option value="0">Januari</option>
                            <option value="1">Februari</option>
                            <option value="2">Maret</option>
                            <option value="3">April</option>
                            <option value="4">Mei</option>
                            <option value="5">Juni</option>
                            <option value="6">Juli</option>
                            <option value="7">Agustus</option>
                            <option value="8" selected>September</option>
                            <option value="9">Oktober</option>
                            <option value="10">November</option>
                            <option value="11">Desember</option>
                        </select>
                        <select class="year-selector" id="yearSelector">
                            <option value="2024">2024</option>
                            <option value="2025" selected>2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                    <div class="calendar-info">
                        <div class="project-duration">Pilih Tanggal Milestone</div>
                        <div class="timeline-weeks" id="calendarStatusDisplay">Klik untuk memilih</div>
                    </div>
                </div>

                <div class="calendar-grid" id="calendarGrid">
                    <!-- Calendar days will be generated by JavaScript -->
                </div>
            </div>

            <div class="existing-milestones-section" id="existingMilestonesSection" style="display: none;">
                <div class="existing-milestones-header">
                    <div class="existing-milestones-title">
                        <i class="fas fa-check-circle"></i>
                        <h4>Milestone Tersimpan</h4>
                    </div>
                </div>
                <div id="existingMilestonesContainer">
                    <!-- Existing milestone cards will be displayed here -->
                </div>
            </div>

            <div class="selected-dates-container" id="selectedDatesContainer" style="display: none;">
                <div class="selected-dates-header">
                    <i class="fas fa-calendar-check"></i>
                    <h4>Tanggal Milestone Terpilih</h4>
                </div>
                <p style="color: #6b7280; font-size: 14px; margin-bottom: 16px;">
                    Berikut adalah tanggal-tanggal yang telah Anda pilih untuk milestone project:
                </p>
                
                <div class="selected-dates-display" id="selectedDatesDisplay">
                    <div style="font-size: 14px; color: #6b7280; margin-bottom: 8px;">
                        <strong>Tanggal terpilih:</strong>
                    </div>
                    <div class="selected-dates-list" id="selectedDatesList">
                        <!-- Selected dates will appear here -->
                    </div>
                    <div style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">
                        <span id="selectedDatesTotal">0</span> tanggal dipilih
                    </div>
                    
                    <button type="button" class="confirm-selection-btn" id="confirmSelectionBtn" onclick="confirmDateSelection()" disabled>
                        <i class="fas fa-check"></i> Konfirmasi & Lanjut ke Milestone
                    </button>
                </div>
            </div>

            <div class="milestones-container" id="milestonesContainer" style="display: none;">
                <!-- Milestone forms will be generated by JavaScript -->
            </div>

            <div class="submit-section" id="submitSection" style="display: none;">
                <h4 style="margin-bottom: 16px; color: #1a1a1a;">
                    <i class="fas fa-paper-plane" style="color: #1d9bf0; margin-right: 8px;"></i>
                    Submit Timeline & Milestone
                </h4>
                <p style="color: #6b7280; font-size: 16px; margin-bottom: 24px;">
                    Pastikan semua milestone telah diisi dengan lengkap sebelum mengirim proposal.
                </p>
                <div class="submit-buttons">
                    <button type="button" onclick="cancelEdit()" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Simpan Milestones
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
    const projectData = {
        id: {{ $project->id }},
        deadline: new Date("{{ \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') }}"),
        timeline_type: "{{ $project->timeline_type }}"
    };

    const existingMilestonesFromDB = @json($project->timelines ?? []);

    let selectedDates = [];
    let dateSelectionConfirmed = false;
    let existingMilestones = [];
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const monthNames = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    const userRole = '{{ auth()->user()->role }}';

    document.addEventListener('DOMContentLoaded', function() {
        loadExistingMilestones();
        
        const now = new Date();
        document.getElementById('monthSelector').value = now.getMonth();
        document.getElementById('yearSelector').value = now.getFullYear();
        
        generateCalendar();
        updateProjectInfo();
        
        document.getElementById('monthSelector').addEventListener('change', generateCalendar);
        document.getElementById('yearSelector').addEventListener('change', generateCalendar);
        
        document.getElementById('timelineForm').addEventListener('submit', handleFormSubmit);
        
        checkAccessControl();
    });

    function checkAccessControl() {
        const isClient = userRole === 'client';
        const isPastDeadline = today > projectData.deadline;
        
        if (isClient || isPastDeadline) {
            const calendarDays = document.querySelectorAll('.calendar-day');
            calendarDays.forEach(day => {
                day.style.cursor = 'not-allowed';
                day.classList.add('disabled');
            });
            
            showNotification(
                isClient ? 'Hanya freelancer yang dapat mengakses dan mengedit kalender' : 'Kalender tidak dapat diakses karena telah melewati deadline',
                'info'
            );
        }
    }

    function loadExistingMilestones() {
        existingMilestones = existingMilestonesFromDB.map(m => ({
            ...m,
            status: m.status || 'pending'
        }));
        
        if (existingMilestones.length > 0) {
            displayExistingMilestones();
            updateProgressDisplayFromExisting();
        }
    }

    function displayExistingMilestones() {
        const section = document.getElementById('existingMilestonesSection');
        const container = document.getElementById('existingMilestonesContainer');
        
        if (existingMilestones.length === 0) {
            section.style.display = 'none';
            return;
        }

        section.style.display = 'block';
        container.innerHTML = '';

        existingMilestones.forEach((milestone, index) => {
            const date = new Date(milestone.milestone_date);
            const daysUntilDeadline = Math.ceil((projectData.deadline - date) / (1000*60*60*24));
            
            const isCompleted = milestone.status === 'selesai';
            const statusBadgeClass = isCompleted ? 'completed' : 'pending';
            const statusBadgeText = isCompleted ? 'Selesai' : 'Belum Selesai';
            
            // Truncate description if too long
            let displayDescription = milestone.description;
            if (displayDescription.length > 300) {
                displayDescription = displayDescription.substring(0, 297) + '...';
            }
            
            const card = document.createElement('div');
            card.className = `milestone-card ${isCompleted ? 'completed' : ''}`;
            card.innerHTML = `
                <div class="milestone-card-header">
                    <div class="milestone-card-number">${milestone.week_number}</div>
                    <div class="milestone-card-info">
                        <h5>
                            Milestone ${milestone.week_number}
                            <span class="milestone-status-badge ${statusBadgeClass}">
                                ${statusBadgeText}
                            </span>
                        </h5>
                        <div class="milestone-card-date">📅 ${formatDate(date)}</div>
                        <div class="milestone-card-days">${daysUntilDeadline} hari menuju deadline</div>
                    </div>
                </div>
                <div class="milestone-card-description">
                    ${displayDescription}
                    ${milestone.description.length > 300 ? '<br><small style="color: #6b7280; font-style: italic;">Deskripsi dipotong untuk tampilan...</small>' : ''}
                </div>
            `;
            container.appendChild(card);
        });
    }

    function updateProgressDisplayFromExisting() {
        const selectedDatesCount = document.getElementById('selectedDatesCount');
        const totalMilestonesDisplay = document.getElementById('totalMilestonesDisplay');
        const statusDisplay = document.getElementById('statusDisplay');
        const calendarStatusDisplay = document.getElementById('calendarStatusDisplay');
        
        const count = existingMilestones.length;
        selectedDatesCount.textContent = `${count} Tanggal`;
        totalMilestonesDisplay.textContent = `${count} Target`;
        statusDisplay.textContent = 'Tersimpan';
        calendarStatusDisplay.textContent = `${count} milestone tersimpan`;
    }

    function updateProjectInfo() {
        document.getElementById("deadlineWarningText").innerText =
            projectData.deadline.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });

        document.getElementById("projectDeadlineDisplay").innerText =
            projectData.deadline.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
        
        updateDateSelectionIndicator('select');
    }

    function updateDateSelectionIndicator(mode) {
        const indicator = document.getElementById('dateSelectionIndicator');
        const title = indicator.querySelector('.date-selection-title');
        const desc = indicator.querySelector('.date-selection-desc');
        
        if (projectData.timeline_type === 'weekly') {
            title.textContent = 'Mode: Pemilihan Tanggal Awal Milestone (Mingguan)';
            desc.textContent = 'Pilih tanggal awal untuk milestone. Tanggal berikutnya akan otomatis diatur setiap 7 hari hingga mendekati deadline.';
            indicator.style.background = 'linear-gradient(135deg, #ddd6fe, #c7d2fe)';
            indicator.style.borderColor = '#8b5cf6';
        } else {
            title.textContent = 'Mode: Pemilihan Tanggal Milestone (Harian)';
            desc.textContent = 'Klik pada tanggal-tanggal di kalender untuk memilih jadwal milestone. Anda dapat memilih lebih dari satu tanggal.';
            indicator.style.background = 'linear-gradient(135deg, #ddd6fe, #c7d2fe)';
            indicator.style.borderColor = '#8b5cf6';
        }
    }

    function generateCalendar() {
        const monthSelector = document.getElementById('monthSelector');
        const yearSelector = document.getElementById('yearSelector');
        const calendarGrid = document.getElementById('calendarGrid');
        
        const month = parseInt(monthSelector.value);
        const year = parseInt(yearSelector.value);
        
        calendarGrid.innerHTML = '';
        
        const dayHeaders = ['MIN', 'SEN', 'SEL', 'RAB', 'KAM', 'JUM', 'SAB'];
        dayHeaders.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.className = 'calendar-day-header';
            dayHeader.textContent = day;
            calendarGrid.appendChild(dayHeader);
        });
        
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startDay = firstDay.getDay();
        
        for (let i = 0; i < startDay; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'calendar-day other-month';
            calendarGrid.appendChild(emptyDay);
        }
        
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            dayElement.textContent = day;
            
            const currentDate = new Date(year, month, day);
            
            if (currentDate.toDateString() === today.toDateString()) {
                dayElement.classList.add('today');
            }
            
            if (currentDate.toDateString() === projectData.deadline.toDateString()) {
                dayElement.classList.add('deadline');
            }
            
            const isSavedMilestone = existingMilestones.some(m => 
                new Date(m.milestone_date).toDateString() === currentDate.toDateString()
            );
            
            const isCurrentlySelected = selectedDates.some(selectedDate => 
                selectedDate.toDateString() === currentDate.toDateString()
            );
            
            if (isSavedMilestone) {
                dayElement.classList.add('saved-milestone');
            } else if (isCurrentlySelected) {
                dayElement.classList.add('selected-date');
            }
            
            if (currentDate > projectData.deadline) {
                dayElement.classList.add('past-deadline');
            } else if (currentDate < today) {
                dayElement.classList.add('past-date');
            }
            
            if (!dateSelectionConfirmed && existingMilestones.length === 0) {
                if (userRole === 'freelancer' && currentDate <= projectData.deadline && currentDate >= today) {
                    if (projectData.timeline_type === 'weekly' && selectedDates.length >= 1 && !isCurrentlySelected) {
                        dayElement.style.cursor = 'not-allowed';
                        dayElement.title = 'Hanya satu tanggal awal yang dapat dipilih untuk timeline mingguan';
                    } else {
                        dayElement.addEventListener('click', (e) => {
                            e.preventDefault();
                            e.stopPropagation();
                            toggleDateSelection(currentDate, dayElement);
                        });
                        dayElement.style.cursor = 'pointer';
                    }
                } else {
                    dayElement.style.cursor = 'not-allowed';
                    dayElement.classList.add('disabled');
                }
            } else {
                dayElement.style.cursor = 'default';
            }
            
            calendarGrid.appendChild(dayElement);
        }
    }

    function toggleDateSelection(date, dayElement) {
        if (dateSelectionConfirmed) return;
        if (userRole !== 'freelancer' || today > projectData.deadline || existingMilestones.length > 0) {
            showNotification('Milestone sudah tersimpan. Tidak dapat menambah milestone baru.', 'error');
            return;
        }
        
        const dateString = date.toDateString();
        const existingIndex = selectedDates.findIndex(selectedDate => 
            selectedDate.toDateString() === dateString
        );
        
        if (existingIndex > -1) {
            selectedDates.splice(existingIndex, 1);
            dayElement.classList.remove('selected-date');
            showNotification(`${formatDate(date)} dihapus dari milestone`, 'info');
        } else {
            if (projectData.timeline_type === 'weekly' && selectedDates.length >= 1) {
                showNotification('Hanya satu tanggal awal yang dapat dipilih untuk timeline mingguan', 'error');
                return;
            }
            selectedDates.push(new Date(date));
            selectedDates.sort((a, b) => a - b);
            dayElement.classList.add('selected-date');
            showNotification(`${formatDate(date)} ditambahkan ke milestone`, 'success');
        }
        
        updateSelectedDatesDisplay();
        updateProgressDisplay();
    }

    function updateSelectedDatesDisplay() {
        const selectedDatesContainer = document.getElementById('selectedDatesContainer');
        const selectedDatesList = document.getElementById('selectedDatesList');
        const selectedDatesTotal = document.getElementById('selectedDatesTotal');
        const confirmBtn = document.getElementById('confirmSelectionBtn');
        
        if (selectedDates.length > 0 && existingMilestones.length === 0) {
            selectedDatesContainer.style.display = 'block';
            selectedDatesContainer.classList.add('fade-in');
            
            selectedDatesList.innerHTML = '';
            let displayDates = selectedDates;

            if (projectData.timeline_type === 'weekly' && dateSelectionConfirmed) {
                displayDates = generateWeeklyMilestoneDates(selectedDates[0]);
            }

            displayDates.forEach((date) => {
                const dateTag = document.createElement('div');
                dateTag.className = 'selected-date-tag';
                dateTag.innerHTML = `<span>${formatDate(date)}</span>`;
                selectedDatesList.appendChild(dateTag);
            });
            
            selectedDatesTotal.textContent = displayDates.length;
            
            if (!dateSelectionConfirmed) {
                confirmBtn.disabled = false;
                confirmBtn.innerHTML = `<i class="fas fa-check"></i> Konfirmasi ${displayDates.length} Tanggal`;
            } else {
                confirmBtn.disabled = true;
                confirmBtn.innerHTML = `<i class="fas fa-check-circle"></i> Tanggal Dikonfirmasi`;
            }
        } else {
            selectedDatesContainer.style.display = 'none';
        }
    }

    function generateWeeklyMilestoneDates(firstDate) {
        const dates = [new Date(firstDate)];
        let currentDate = new Date(firstDate);
        const deadline = new Date(projectData.deadline);

        // Generate weekly milestones
        while (currentDate < deadline) {
            currentDate = new Date(currentDate);
            currentDate.setDate(currentDate.getDate() + 7);
            if (currentDate <= deadline) {
                dates.push(new Date(currentDate));
            }
        }

        // Always add deadline as final milestone for weekly timeline
        // even if it's less than 7 days from the last milestone
        const lastDate = dates[dates.length - 1];
        if (lastDate.toDateString() !== deadline.toDateString()) {
            dates.push(new Date(deadline));
        }

        return dates;
    }

    function updateProgressDisplay() {
        const selectedDatesCount = document.getElementById('selectedDatesCount');
        const totalMilestonesDisplay = document.getElementById('totalMilestonesDisplay');
        const statusDisplay = document.getElementById('statusDisplay');
        const calendarStatusDisplay = document.getElementById('calendarStatusDisplay');
        
        let count = selectedDates.length;
        if (projectData.timeline_type === 'weekly' && dateSelectionConfirmed) {
            count = generateWeeklyMilestoneDates(selectedDates[0]).length;
        }
        
        if (count > 0) {
            selectedDatesCount.textContent = `${count} Tanggal`;
            totalMilestonesDisplay.textContent = `${count} Target`;
            statusDisplay.textContent = dateSelectionConfirmed ? 'Dikonfirmasi' : `${count} dipilih`;
            calendarStatusDisplay.textContent = dateSelectionConfirmed ? 'Tanggal dikonfirmasi' : `${count} tanggal dipilih`;
        } else {
            selectedDatesCount.textContent = '0 Tanggal';
            totalMilestonesDisplay.textContent = '0 Target';
            statusDisplay.textContent = 'Pilih Tanggal';
            calendarStatusDisplay.textContent = 'Klik untuk memilih';
        }
    }

    function confirmDateSelection() {
        if (selectedDates.length === 0) {
            showNotification('Pilih minimal satu tanggal untuk melanjutkan', 'error');
            return;
        }

        dateSelectionConfirmed = true;

        if (projectData.timeline_type === 'weekly') {
            selectedDates = generateWeeklyMilestoneDates(selectedDates[0]);
        }

        generateMilestoneForms();
        
        updateSelectedDatesDisplay();
        updateProgressDisplay();
        generateCalendar();
        
        showNotification(`${selectedDates.length} tanggal berhasil dikonfirmasi. Silakan isi milestone!`, 'success');
    }

    function formatDate(date, includeDay = false) {
        const options = { 
            day: '2-digit', 
            month: 'long', 
            year: 'numeric' 
        };
        let formatted = date.toLocaleDateString('id-ID', options);
        if (includeDay) {
            const dayName = dayNames[date.getDay()];
            formatted = `${dayName}, ${formatted}`;
        }
        return formatted;
    }

    function getMilestonePlaceholder(milestoneNumber, date, daysUntilDeadline) {
        const isEarlyMilestone = milestoneNumber <= 2;
        const isFinalMilestone = daysUntilDeadline <= 7;

        if (isFinalMilestone) {
            return `Target Milestone Final (${daysUntilDeadline} hari menuju deadline):

• Finalisasi semua fitur yang tersisa
• Testing menyeluruh dan bug fixing  
• Deployment ke server production
• Final review dan quality assurance
• Dokumentasi project dan handover
• Training client jika diperlukan

Deliverable yang diharapkan:
- Project siap launch 100%
- Dokumentasi lengkap
- Testing report
- User manual dan panduan`;
        } else if (isEarlyMilestone) {
            return `Target Milestone Awal (${daysUntilDeadline} hari menuju deadline):

• Setup dan persiapan project
• Analysis dan design requirement  
• Database design dan setup environment
• Core functionality development
• Basic UI/UX implementation

Deliverable yang diharapkan:
- Project structure dan arsitektur
- Database schema
- Basic features working
- UI prototype yang dapat diakses`;
        } else {
            return `Target Milestone Tengah (${daysUntilDeadline} hari menuju deadline):

• Development fitur sesuai requirements
• Integration dengan sistem yang ada
• Testing dan debugging
• UI/UX improvements
• Performance optimization

Deliverable yang diharapkan:
- Completed features sesuai scope
- Testing results
- Updated documentation
- Working prototype dengan fitur utama`;
        }
    }

    function generateMilestoneForms() {
        const container = document.getElementById('milestonesContainer');
        container.innerHTML = '';
        container.style.display = 'block';
        container.classList.add('fade-in');

        const form = document.getElementById('timelineForm');
        form.querySelectorAll('input[name="milestone_dates[]"], input[name="week_numbers[]"]').forEach(el => el.remove());

        let datesToSend = projectData.timeline_type === 'weekly' ? [selectedDates[0]] : selectedDates;

        datesToSend.forEach((date) => {
            const inputDate = document.createElement('input');
            inputDate.type = 'hidden';
            inputDate.name = 'milestone_dates[]';
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            inputDate.value = `${year}-${month}-${day}`;
            form.appendChild(inputDate);
        });

        let formDates = projectData.timeline_type === 'weekly' ? generateWeeklyMilestoneDates(selectedDates[0]) : selectedDates;

        if (formDates.length === 0) {
            showNotification('Tidak ada tanggal milestone yang valid untuk ditampilkan', 'error');
            return;
        }

        formDates.forEach((date, index) => {
            const milestoneNumber = index + 1;
            const daysUntilDeadline = Math.ceil((projectData.deadline - date) / (1000 * 60 * 60 * 24));
            
            const placeholder = getMilestonePlaceholder(milestoneNumber, date, daysUntilDeadline);

            const milestoneItem = document.createElement('div');
            milestoneItem.className = 'milestone-item';
            milestoneItem.innerHTML = `
                <div class="milestone-header">
                    <div class="milestone-title-section">
                        <div class="milestone-number">${milestoneNumber}</div>
                        <div class="milestone-info">
                            <h4>Milestone ${milestoneNumber}</h4>
                            <div class="milestone-date">${formatDate(date)}</div>
                            <div class="milestone-days">${daysUntilDeadline} hari menuju deadline</div>
                        </div>
                    </div>
                    <div class="milestone-status">Baru</div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="milestone_${milestoneNumber}">
                        <i class="fas fa-clipboard-list"></i>
                        Deskripsi Target & Deliverable
                    </label>
                    <textarea 
                        name="milestone_descriptions[]" 
                        id="milestone_${milestoneNumber}" 
                        class="form-textarea"
                        placeholder="${placeholder}" 
                        required
                        maxlength="2000"
                    ></textarea>
                    <div class="char-counter" id="charCounter_${milestoneNumber}">0/2000 karakter</div>
                    <div class="form-help">
                        <div class="form-help-title">
                            <i class="fas fa-lightbulb"></i>
                            Panduan Pengisian:
                        </div>
                        • <strong>Wajib minimal 50 karakter</strong> untuk deskripsi yang memadai<br>
                        • Jelaskan target spesifik yang ingin dicapai pada tanggal ${formatDate(date, true)}<br>
                        • Sebutkan deliverable yang dapat diukur dan diverifikasi<br>
                        • Pertimbangkan waktu ${daysUntilDeadline} hari dari sekarang hingga milestone ini<br>
                        • Gunakan bullet points untuk kejelasan dan detail yang terstruktur
                    </div>
                    <div class="form-example">
                        <div class="form-example-title">Contoh Format yang Baik (Minimal 50 Karakter):</div>
                        <strong>Target Utama:</strong> [Apa yang ingin dicapai]<br>
                        • Poin spesifik 1 dengan detail teknis<br>
                        • Poin spesifik 2 dengan timeline internal<br>
                        • Poin spesifik 3 dengan kriteria sukses<br><br>
                        <strong>Deliverable:</strong><br>
                        - Item yang dapat diukur 1 (contoh: 5 halaman web selesai)<br>
                        - Item yang dapat diukur 2 (contoh: Database dengan 10 tabel)<br>
                        - Item yang dapat diukur 3 (contoh: Dokumentasi API lengkap)
                    </div>
                </div>
            `;
            container.appendChild(milestoneItem);

            const inputWeek = document.createElement('input');
            inputWeek.type = 'hidden';
            inputWeek.name = 'week_numbers[]';
            inputWeek.value = milestoneNumber;
            form.appendChild(inputWeek);

            const textarea = document.getElementById(`milestone_${milestoneNumber}`);
            const charCounter = document.getElementById(`charCounter_${milestoneNumber}`);
            
            textarea.addEventListener('input', function() {
                const length = this.value.length;
                const minChars = 50;
                let counterText = `${length}/2000 karakter`;
                
                if (length < minChars) {
                    counterText += ` (Minimal ${minChars} karakter wajib)`;
                    charCounter.className = 'char-counter error';
                } else if (length > 1800) {
                    charCounter.className = 'char-counter error';
                } else if (length > 1500) {
                    charCounter.className = 'char-counter warning';
                } else {
                    charCounter.className = 'char-counter';
                }
                
                charCounter.textContent = counterText;
                
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });

        document.getElementById('submitSection').style.display = 'block';
        document.getElementById('submitSection').classList.add('fade-in');
    }

    function cancelEdit() {
        selectedDates = [];
        dateSelectionConfirmed = false;
        
        document.getElementById('selectedDatesContainer').style.display = 'none';
        document.getElementById('milestonesContainer').style.display = 'none';
        document.getElementById('submitSection').style.display = 'none';
        
        if (existingMilestones.length > 0) {
            document.getElementById('existingMilestonesSection').style.display = 'block';
            updateProgressDisplayFromExisting();
        } else {
            updateProgressDisplay();
        }
        
        generateCalendar();
        
        showNotification('Pengisian milestone dibatalkan', 'info');
    }

    function handleFormSubmit(e) {
        e.preventDefault();
        
        const form = e.target;
        
        if (selectedDates.length === 0) {
            showNotification('Harap pilih minimal satu tanggal untuk milestone', 'error');
            return;
        }
        
        if (!dateSelectionConfirmed) {
            showNotification('Harap konfirmasi tanggal yang dipilih terlebih dahulu', 'error');
            return;
        }
        
        const descriptions = new FormData(form).getAll('milestone_descriptions[]');
        let emptyFields = [];
        let tooShortFields = [];
        
        descriptions.forEach((desc, index) => {
            if (!desc.trim()) {
                emptyFields.push(`Milestone ${index + 1}`);
            } else if (desc.trim().length < 50) {
                tooShortFields.push(`Milestone ${index + 1}`);
            }
        });
        
        if (emptyFields.length > 0) {
            showNotification(`Harap lengkapi: ${emptyFields.join(', ')}`, 'error');
            return;
        }
        
        if (tooShortFields.length > 0) {
            showNotification(`Deskripsi terlalu singkat: ${tooShortFields.join(', ')} (minimal 50 karakter)`, 'error');
            return;
        }

        if (projectData.timeline_type === 'weekly') {
            const expectedCount = generateWeeklyMilestoneDates(selectedDates[0]).length;
            if (descriptions.length !== expectedCount) {
                showNotification(`Jumlah deskripsi (${descriptions.length}) tidak sesuai dengan jumlah milestone mingguan (${expectedCount})`, 'error');
                return;
            }
        }
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan Timeline...';
        submitBtn.disabled = true;
        
        const formData = new FormData(form);
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        
        if (!csrfToken) {
            showNotification('CSRF token tidak ditemukan', 'error');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            return;
        }

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (data.milestones) {
                    existingMilestones = data.milestones;
                }
                
                selectedDates = [];
                dateSelectionConfirmed = false;
                
                document.getElementById('selectedDatesContainer').style.display = 'none';
                document.getElementById('milestonesContainer').style.display = 'none';
                document.getElementById('submitSection').style.display = 'none';
                
                displayExistingMilestones();
                updateProgressDisplayFromExisting();
                
                generateCalendar();
                
                showNotification(data.message || 'Timeline & Milestone berhasil disimpan!', 'success');
                
                setTimeout(() => {
                    const section = document.getElementById('existingMilestonesSection');
                    if (section && section.style.display !== 'none') {
                        section.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'start' 
                        });
                    }
                }, 500);
            } else {
                showNotification(data.message || 'Terjadi kesalahan saat menyimpan', 'error');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            showNotification('Terjadi kesalahan saat menghubungi server', 'error');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            ${message}
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 3000);
    }
</script>

</body>
</html>
@endsection