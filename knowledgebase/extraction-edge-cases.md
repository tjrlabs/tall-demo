# Event Date Extraction — Edge Cases

Edge cases where Gemini may return a wrong, inconsistent, or null `event_at`.

**Verdict key:** ✅ Correct &nbsp;|&nbsp; ⚠️ Debatable &nbsp;|&nbsp; ❌ Wrong &nbsp;|&nbsp; ⏳ Pending

---

### EC-1 · Multiple dates in one post
**Risk:** Model picks the wrong date with no consistent rule  
**Example:** Post has a VIP night July 10 and a public event July 11 — which one is "the event"?  
**Post:** [Post 9](https://tall-demo-production.up.railway.app/posts/9)  
**Result:** `2026-07-10T18:00:00`  
**Confidence:** 1.0  
**Verdict:** ⚠️ Picked the first date (VIP night) rather than the main public event. Defensible but inconsistent.

---

### EC-2 · Doors time vs. show time
**Risk:** Model returns doors-open time instead of the actual event start  
**Example:** "Doors open at 7:30 PM, support act at 8:00 PM, headliner at 9:00 PM"  
**Post:** [Post 10](https://tall-demo-production.up.railway.app/posts/10)  
**Result:** `2026-08-15T21:00:00`  
**Confidence:** 1.0  
**Verdict:** ✅ Correctly picked The National's 9 PM headline set, not the 7:30 PM doors or 8 PM support.

---

### EC-3 · Date range (closure)
**Risk:** Model returns start or end of a range instead of null  
**Example:** "Closed July 6 through July 19" — there is no explicit clock time  
**Post:** [Post 11](https://tall-demo-production.up.railway.app/posts/11)  
**Result:** `2026-07-06T00:00:00` *(previously `null` — rule changed)*  
**Confidence:** 0.95  
**Verdict:** ✅ Correctly applied new rule: date present, no clock time → midnight. Picked start of range (July 6).

---

### EC-4 · Event date already in the past
**Risk:** Model returns the past date, making the reminder useless  
**Example:** Post says "Gala held on May 9, 2026" — today is June 5  
**Post:** [Post 12](https://tall-demo-production.up.railway.app/posts/12)  
**Result:** `2026-05-09T18:00:00`  
**Confidence:** 1.0  
**Verdict:** ⚠️ Technically correct extraction, but past events should return null for a reminder app.

---

### EC-5 · Date with no time
**Risk:** Model invents a time (midnight, noon) rather than returning null  
**Example:** "Farmers Market opens June 20" — no clock time mentioned  
**Post:** [Post 13](https://tall-demo-production.up.railway.app/posts/13)  
**Result:** `2026-06-20T00:00:00` *(previously `null` — rule changed)*  
**Confidence:** 0.9  
**Verdict:** ✅ Correctly applied new rule: date present, no clock time → midnight.

---

### EC-6 · Registration deadline mistaken for event date
**Risk:** Model picks the registration cutoff instead of the actual event  
**Example:** "Sign-ups close June 20 — race is July 5 at 8 AM"  
**Post:** [Post 14](https://tall-demo-production.up.railway.app/posts/14)  
**Result:** `2026-07-05T08:00:00`  
**Confidence:** 1.0  
**Verdict:** ✅ Correctly picked the race date (July 5, 8 AM), ignored the June 20 deadline.

---

### EC-7 · Ambiguous year
**Risk:** Model assumes wrong year when none is stated  
**Example:** "Regatta returns this August 22" — no year given  
**Post:** [Post 15](https://tall-demo-production.up.railway.app/posts/15)  
**Result:** `2026-08-22T10:00:00`  
**Confidence:** 0.9 — year was inferred, not stated  
**Verdict:** ✅ Correctly inferred 2026 as the upcoming year and used the explicitly stated 10:00 AM start time.

---

### EC-8 · Vague time of day
**Risk:** Model guesses a time from words like "evening" or "late-night"  
**Example:** "Doors open in the evening" — no clock time  
**Post:** [Post 16](https://tall-demo-production.up.railway.app/posts/16)  
**Result:** `null`  
**Confidence:** 0.0  
**Verdict:** ✅ Correctly returned null — vague time word ("evening") with a date still returns null per prompt rule.

---

### EC-9 · Time expressed as a range
**Risk:** Model returns the end time instead of the start  
**Example:** "Running from 10:00 AM to 4:00 PM" — should return 10:00 AM  
**Post:** [Post 17](https://tall-demo-production.up.railway.app/posts/17)  
**Result:** `2026-06-27T10:00:00`  
**Confidence:** 1.0  
**Verdict:** ✅ Correctly returned the start time (10:00 AM), not the end time (4:00 PM).

---

### EC-10 · Historical/reference dates in body
**Risk:** Model confuses biographical or historical years with the event date  
**Example:** "Club founded in 1974… match on August 8, 2026 at 7:30 PM"  
**Post:** [Post 18](https://tall-demo-production.up.railway.app/posts/18)  
**Result:** `2026-08-08T19:30:00`  
**Confidence:** 1.0  
**Verdict:** ✅ Correctly extracted Aug 8 at 7:30 PM, ignored 1974 and 1978 historical references.

---

### EC-11 · Relative dates only
**Risk:** Depends entirely on `{{today}}` being correct; no absolute date to fall back on  
**Example:** "Join us this coming Thursday at 6:30 PM" — no explicit date  
**Post:** [Post 19](https://tall-demo-production.up.railway.app/posts/19)  
**Result:** `2026-06-11T18:30:00`  
**Confidence:** 0.7  
**Verdict:** ✅ Correctly resolved "this coming Thursday" to June 11 (today is Friday, June 5) at 6:30 PM. Fixed by including the day name in `{{today}}` (e.g. "Friday, 2026-06-05") so the model doesn't have to calculate it.

---

### EC-12 · Recurring event
**Risk:** Model guesses a specific date or returns null inconsistently  
**Example:** "Every Sunday from 8:00 AM to 11:00 AM"  
**Post:** [Post 20](https://tall-demo-production.up.railway.app/posts/20)  
**Result:** `null`  
**Confidence:** 0.0  
**Verdict:** ✅ Correctly returned null — no single event date to extract.

---

### EC-13 · Multiple separate events in one post
**Risk:** Model picks one event arbitrarily with no clear rule  
**Example:** "Secondary Stage July 24 at 5 PM; Main Stage headliner July 25 at 8 PM"  
**Post:** [Post 21](https://tall-demo-production.up.railway.app/posts/21)  
**Result:** `2026-07-25T20:00:00` *(previously `2026-07-24T17:00:00` — now picks headliner)*  
**Confidence:** 1.0  
**Verdict:** ✅ Now correctly picks the headliner (July 25 at 8 PM) over the opening act. Previously ⚠️ — model improved between runs.

---

### EC-14 · Season or month reference only
**Risk:** Model hallucinates a specific date from a vague window  
**Example:** "Show planned for fall 2026" — no specific date  
**Post:** [Post 22](https://tall-demo-production.up.railway.app/posts/22)  
**Result:** `null`  
**Confidence:** 0.0  
**Verdict:** ✅ Correctly returned null — "fall 2026" is too vague for a specific timestamp.

---

### EC-15 · Dates embedded in non-date context
**Risk:** Model misreads addresses, phone numbers, or historical years as dates  
**Example:** "Departing from 302 Royal Ave… homes built as far back as 1893… call 604-527-4640"  
**Post:** [Post 23](https://tall-demo-production.up.railway.app/posts/23)  
**Result:** `2026-09-12T10:00:00`  
**Confidence:** 0.8 — year inferred  
**Verdict:** ✅ Correctly extracted Sept 12 at 10 AM, ignored 302, 1893, 1905, and the phone number.

---

### EC-16 · Multi-day event with a clear opening night
**Risk:** Model picks a middle or end date instead of the first night  
**Example:** "Festival runs Sept 24–Oct 4; Opening Night Sept 24 at 7:30 PM"  
**Post:** [Post 24](https://tall-demo-production.up.railway.app/posts/24)  
**Result:** `2026-09-24T19:30:00`  
**Confidence:** 1.0  
**Verdict:** ✅ Correctly picked Opening Night (Sept 24 at 7:30 PM), not the closing date (Oct 4).

---

### EC-17 · No AM/PM specified
**Risk:** Model returns the wrong half of the day  
**Example:** "Session begins at 6:00" — sunrise yoga, should be AM not PM  
**Post:** [Post 25](https://tall-demo-production.up.railway.app/posts/25)  
**Result:** `2026-07-12T06:00:00`  
**Confidence:** 1.0 *(previously 0.9 — model now more certain from context)*  
**Verdict:** ✅ Correctly inferred 6:00 AM from context ("Sunrise Yoga", "arrive by 5:45").

---

### EC-18 · No date or time at all
**Risk:** Model hallucinates a plausible date instead of returning null  
**Example:** "Details still being finalized. Stay tuned for updates."  
**Post:** [Post 26](https://tall-demo-production.up.railway.app/posts/26)  
**Result:** `null`  
**Confidence:** 0.0  
**Verdict:** ✅ Correctly returned null — no date hallucinated.
